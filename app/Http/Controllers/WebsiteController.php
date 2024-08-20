<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Services\DomainMetricsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    protected $domainMetricsService;

    public function __construct(DomainMetricsService $domainMetricsService)
    {
        $this->domainMetricsService = $domainMetricsService;
    }

    public function fetchMetrics($url)
    {
        try {
            $url = preg_replace('#^https?://#', '', $url);

            $metrics = $this->domainMetricsService->fetchMetrics($url);

            if (!$metrics) {
                Log::warning('Failed to fetch domain metrics', ['url' => $url]);
                return response()->json(['error' => 'Unable to fetch domain metrics'], 500);
            }

            return response()->json($metrics);

        } catch (\Exception $e) {
            Log::error('Error fetching domain metrics', [
                'url' => $url,
                'exception' => $e->getMessage()
            ]);
            return response()->json(['error' => 'An error occurred while fetching domain metrics'], 500);
        }
    }

    public function add_web_step1()
    {
        return view('publishers.website.add-web-step1');
    }

    public function add_web_step2()
    {
        if (!Session::has('step1')) {
            Flashy::warning('🔄 Please complete all previous steps', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        Flashy::mutedDark('✅ Step 1: Data has been saved successfully.', '#');
        return view('publishers.website.add-web-step2');
    }

    public function add_web_step3()
    {
        if (!Session::has('step1') || !Session::has('step2')) {
            Flashy::warning('🔄 Please complete all previous steps', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        Flashy::mutedDark('✅ Step 2: Data has been saved successfully.', '#');
        return view('publishers.website.add-web-step3');
    }

    public function add_web_step4()
    {
        if (!Session::has('step1') || !Session::has('step2')) {
            Flashy::warning('🔄 Please complete all previous steps', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        Flashy::mutedDark('✅ Step 3: Data has been saved successfully.', '#');
        return view('publishers.website.add-web-step4');
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'web_url' => 'required|url|unique:websites,web_url',
        ]);

        $domain = parse_url($request->web_url, PHP_URL_HOST);

        try {
            $metrics = $this->domainMetricsService->fetchMetrics($domain);

            if ($metrics) {
                Session::put('domain_metrics', $metrics);
            } else {
                Session::put('domain_metrics_error', 'Unable to fetch domain metrics.');
            }

            Session::put('step1', $request->web_url);
            return redirect()->route('publishers.add.websiteStep2')->with('success', 'Step 1: Data has been saved successfully.');
        } catch (\Exception $e) {
            Log::error('Error in postStep1', ['exception' => $e->getMessage()]);
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'An error occurred while processing your request.');
        }
    }

    public function postStep2(Request $request)
    {
        $validated = $request->validate([
            'web_description' => 'required|string',
            'audience' => 'required|string',
            'images_per_post' => 'required|integer',
            'post_link' => 'required|integer',
            'link_type' => 'required|string',
            'language' => 'required|string',
            'categories' => 'required|array|max:3',
            'delicated_topics' => 'required|array',
            'sponsorship' => 'required|string',
            'publish_web' => 'nullable|boolean',
            'publish_categories' => 'nullable|boolean',
            'normal_price' => 'required|numeric',
            'dedicated_price' => 'nullable|numeric',
            '800_words' => 'nullable|numeric',
            '1000_words' => 'nullable|numeric',
            '1200_words' => 'nullable|numeric',
            'facebook_link' => 'nullable|url',
            'x_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'diffusion_price' => 'nullable|numeric',
        ]);

        try {
            $categoriesJson = json_encode($request->input('categories'));

            Session::put('step2', array_merge(
                $request->except('_token', 'categories'),
                [
                    'categories' => $categoriesJson,
                ]
            ));

            Flashy::mutedDark('✅ Step 2: Data has been saved successfully.', '#');
            return redirect()->route('publishers.add.websiteStep3')->with('success', 'Step 2: Data has been saved successfully.');
        }
        catch (\Exception $e) {
            Log::error('Error in postStep2', ['exception' => $e->getMessage()]);
            return redirect()->route('publishers.add.websiteStep2')
                ->with('error', 'An error occurred while processing your request.');
        }
    }

    public function storeAllStep(Request $request)
    {
        try {
            $step1Data = Session::get('step1', []);
            $step2Data = Session::get('step2', []);

            if (empty($step1Data) || empty($step2Data)) {
                Flashy::mutedDark('🔄 Please complete all previous steps', '#');
                return redirect()->route('publishers.add.websiteStep1')->with('error', 'Please complete all previous steps.');
            }

            if (!is_array($step1Data)) {
                $step1Data = ['web_url' => $step1Data];
            }

            $allData = array_merge($step1Data, $step2Data, $request->all());

            $allData['categories'] = json_decode($allData['categories'], true);

            $userId = auth()->id();
            $website = Website::create([
                'user_id' => $userId,
                'web_url' => $allData['web_url'] ?? null,
                'web_description' => $allData['web_description'] ?? null,
                'audience' => $allData['audience'] ?? null,
                'language' => $allData['language'] ?? null,
                'images_per_post' => $allData['images_per_post'] ?? null,
                'post_link' => $allData['post_link'] ?? null,
                'link_type' => $allData['link_type'] ?? null,
                'categories' => $allData['categories'] ? json_encode($allData['categories']) : null,
                'delicated_topics' => $allData['delicated_topics'] ? json_encode($allData['delicated_topics']) : null,
                'sponsorship' => $allData['sponsorship'] ?? null,
                'publish_web' => $allData['publish_web'] ?? 0,
                'publish_categories' => $allData['publish_categories'] ?? 0,
                'normal_price' => $allData['normal_price'] ?? null,
                'dedicated_price' => $allData['dedicated_price'] ?? null,
                '800_words' => $allData['800_words'] ?? 0,
                '1000_words' => $allData['1000_words'] ?? 0,
                '1200_words' => $allData['1200_words'] ?? 0,
                'facebook_link' => $allData['facebook_link'] ?? null,
                'x_link' => $allData['x_link'] ?? null,
                'linkedin_link' => $allData['linkedin_link'] ?? null,
                'diffusion_price' => $allData['diffusion_price'] ?? null,
            ]);

            Session::forget('step1');
            Session::forget('step2');

            Flashy::mutedDark('✅ Website information has been successfully saved.', '#');
            return redirect()->route('publishers.website')->with('success', 'Website information has been successfully saved.');
        } catch (\Exception $e) {
            Log::error('Error in storeAllStep', ['exception' => $e->getMessage()]);
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'An error occurred while saving the website information.');
        }
    }

    // website delete 🌟

    public function webDelete($id)
    {
        try {
            // Find the website by ID
            $website = Website::find($id);

            // Check if the website exists
            if ($website) {
                // Attempt to delete the website
                $website->delete();

                // Return a success response
                return response()->json(['success' => true, 'message' => 'Website has been successfully deleted.']);
            } else {
                // Return a failure response if the website doesn't exist
                return response()->json(['success' => false, 'message' => 'Website not found.']);
            }
        } catch (\Exception $e) {
            // Log the exception details
            Log::error('Error deleting website: ', ['id' => $id, 'error' => $e->getMessage()]);

            // Return a failure response with a generic error message
            return response()->json(['success' => false, 'message' => 'Something went wrong while deleting the website.']);
        }
    }
    // view website 🌟
    public function website_detail($encodedId)
    {
        $websiteId = base64_decode($encodedId);

        $website = Website::find($websiteId);
        // return $website;
        return view('publishers.website.website-detail', compact('website'));
    }
}
