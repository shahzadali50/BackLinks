<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function add_web_step1()
    {
        return view('publishers.website.add-web-step1');
    }
    public function add_web_step2()
    {
        // Check if the session data for step1 and step2 exists
        if (!Session::has('step1')) {
            Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        return view('publishers.website.add-web-step2');
    }
    public function add_web_step3()
    {
        // Check if the session data for step1 and step2 exists
        if (!Session::has('step1') || !Session::has('step2')) {
            Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        Flashy::mutedDark('✅ Step 3: Data has been saved successfully.', '#');
        return view('publishers.website.add-web-step3');
    }
    public function add_web_step4()
    {
        // Check if the session data for step1 and step2 exists
        if (!Session::has('step1') || !Session::has('step2')) {
            Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('publishers.add.websiteStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        return view('publishers.website.add-web-step4');
    }
    public function postStep1(Request $request)
    {
        $request->validate([
            'web_url' => 'required|url|unique:websites,web_url',
        ]);

        Session::put('step1', $request->web_url);
        Flashy::mutedDark(' ✅ Step 1: Data has been saved successfully. ', '#');

        return redirect()->route('publishers.add.websiteStep2')->with('success', 'Step 1: Data has been saved successfully.');
    }

    public function postStep2(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'web_description' => 'required|string',
            'audience' => 'required|string',
            'images_per_post' => 'required|integer',
            'post_link' => 'required|integer',
            'link_type' => 'required|string',
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

        // Encode categories as JSON
        $categoriesJson = json_encode($request->input('categories'));

        // Store data in session
        Session::put('step2', array_merge(
            $request->except('_token', 'categories'),
            [
                'categories' => $categoriesJson,
            ]
        ));

        Flashy::mutedDark('✅ Step 3: Data has been saved successfully.', '#');

        return redirect()->route('publishers.add.websiteStep3')->with('success', 'Step 2: Data has been saved successfully.');;
    }


    public function storeAllStep(Request $request)
    {
        // Retrieve data from session
        $step1Data = Session::get('step1', []);
        $step2Data = Session::get('step2', []);

        // Validate that necessary session data exists
        if (empty($step1Data) || empty($step2Data)) {
            Flashy::mutedDark('🔄 Please complete all previous steps ', '#');
            return redirect()->route('publishers.add.websiteStep1')->with('error', 'Please complete all previous steps.');
        }

        // Ensure step1Data is wrapped in an array
        if (!is_array($step1Data)) {
            $step1Data = ['web_url' => $step1Data];
        }

        // Combine all data
        $allData = array_merge($step1Data, $step2Data, $request->all());

        // Decode categories JSON
        $allData['categories'] = json_decode($allData['categories'], true);

        // Create a new Website entry
        $userId = auth()->id();
        $website = Website::create([
            'user_id' => $userId,
            'web_url' => $allData['web_url'] ?? null,
            'web_description' => $allData['web_description'] ?? null,
            'audience' => $allData['audience'] ?? null,
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

        // Destroy the session data
        Session::forget('step1');
        Session::forget('step2');

        // Redirect with success message
        Flashy::mutedDark('✅ Website information has been successfully saved.', '#');
        return redirect()->route('publishers.website')->with('success', 'Website information has been successfully saved.');
    }
    public function webDelete($id){
        $website = Website::find($id);
        if($website){
            $website->delete();
            Flashy::mutedDark('✅ Website information has been successfully deleted.', '#');
            return redirect()->route('publishers.website')->with('delete', 'Website information has been successfully deleted.');
        }else{
            Flashy::warning('�� Something went wrong while deleting the website.', '#');
            return redirect()->route('publishers.website')->with('error', 'Something went wrong while deleting the website.');
        }

    }



}
