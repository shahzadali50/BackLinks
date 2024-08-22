<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Website;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function list()
    {
        $user = auth()->user();
        // Fetch projects associated with the logged-in user using where condition
        $projects = Project::where('user_id', $user->id)->get();
        return view('advertiser.project.list', compact('projects'));
    }
    public function projectStep1()
    {
        return view('advertiser.project.project-step1');
    }
    public function projectStep2()
    {
        if (!Session::has('project_step1')) {
            // Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('advertiser.projectStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        return view('advertiser.project.project-step2');
    }
    public function projectStep3()
    {
        if (!Session::has('project_step1') || !Session::has('project_step2')) {
            // Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('advertiser.projectStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        return view('advertiser.project.project-step3');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'url' => 'required|url',
            'categories' => 'required|array',
            'language' => 'required|array',
            'countries' => 'required|array',
            'objectives' => 'required|array',
        ]);

        $request->session()->put('project_step1', $request->only([
            'project_name',
            'url',
            'categories',
            'language',
            'countries',
            'objectives'
        ]));
        Flashy::mutedDark(' ✅ Step 1: Data has been saved successfully. ', '#');

        return redirect()->route('advertiser.projectStep2')->with('success', 'Step 1: Data has been saved successfully.');
    }
    public function storeStep2(Request $request)
    {
        $request->validate([
            'competitor1' => 'nullable|url|different:competitor2|different:competitor3',
            'competitor2' => 'nullable|url|different:competitor1|different:competitor3',
            'competitor3' => 'nullable|url|different:competitor1|different:competitor2',
        ]);

        Session::put('project_step2', $request->only(['competitor1', 'competitor2', 'competitor3']));
        Flashy::mutedDark(' ✅ Step 2: Data has been saved successfully. ', '#');
        return redirect()->route('advertiser.projectStep3')->with('success', 'Step 2: Data has been saved successfully.');
    }
    public function storeStep3(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string',
            'trackkeywords' => 'required|array',
            'track_device' => 'required|string',
        ]);

        $step1Data = $request->session()->get('project_step1');
        $step2Data = $request->session()->get('project_step2');
        $step3Data = $request->all();

        $userId = auth()->id();

        $project = new Project();
        $project->user_id = $userId;
        $project->name = $step1Data['project_name'];
        $project->url = $step1Data['url'];
        $project->categories = json_encode($step1Data['categories']);
        $project->languages = json_encode($step1Data['language']);
        $project->countries = json_encode($step1Data['countries']);
        $project->objectives = json_encode($step1Data['objectives']);
        $project->competitors = json_encode([
            'competitor1' => $step2Data['competitor1'] ?? '',
            'competitor2' => $step2Data['competitor2'] ?? '',
            'competitor3' => $step2Data['competitor3'] ?? '',
        ]);
        $project->keywords = $step3Data['keywords'];
        $project->trackkeywords = json_encode($step3Data['trackkeywords']);
        $project->track_device = $step3Data['track_device'];
        $project->save();

        // Clear session data
        $request->session()->forget(['project_step1', 'project_step2']);
        Flashy::mutedDark(' ✅ Project created successfully! ', '#');

        return redirect()->route('advertiser.project.list')->with('success', 'Project created successfully!');
    }
    public function projectDelete($id)
    {
        $project = Project::find($id);
        if ($project) {
            $project->delete();
            return response()->json(['success' => true, 'message' => 'Project information has been successfully deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong while deleting the project.']);
        }
    }
    // project detail🌟
    public function projectDetail($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $project = Project::find($decodedId);
        // return $project;
        if ($project) {
            return view('advertiser.project.detail', compact('project'));
        } else {
            abort(404, 'Project not found');
        }
    }
    // project Edit
    public function projectEdit($encodedId)
    {
        $decodedId = base64_decode($encodedId);
        $project = Project::find($decodedId);

        if ($project) {
            // Assuming competitors are stored as JSON in the database
            $competitors = json_decode($project->competitors, true);
            $trackKeywords = json_decode($project->trackkeywords, true);

            return view('advertiser.project.edit', [
                'project' => $project,
                'competitors' => $competitors,
                'trackKeywords' => $trackKeywords,
            ]);
        } else {
            abort(404, 'Project not found');
        }
    }

    // update project step 1🌟
    public function updateStep1(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'categories' => 'required|array',

            'language' => 'required|array',

            'countries' => 'required|array',

            'objectives' => 'required|array',

        ]);

        $project = Project::findOrFail($id);
        $project->name = $validated['name'];
        $project->url = $validated['url'];
        $project->categories = json_encode($validated['categories']);
        $project->languages = json_encode($validated['language']);
        $project->countries = json_encode($validated['countries']);
        $project->objectives = json_encode($validated['objectives']);
        $project->save();
        Flashy::mutedDark(' ✅ Project data updated successfully ', '#');

        return redirect()->back()->with('success', 'Project data updated successfully!');
    }
    // update step3🌟
    public function updateStep2(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'competitor1' => 'required|url|different:competitor2|different:competitor3',
            'competitor2' => 'required|url|different:competitor1|different:competitor3',
            'competitor3' => 'required|url|different:competitor1|different:competitor2',
        ]);

        // Find the project by ID
        $project = Project::find($id);

        if ($project) {
            // Prepare competitors data for storage
            $competitors = [
                'competitor1' => $validatedData['competitor1'],
                'competitor2' => $validatedData['competitor2'],
                'competitor3' => $validatedData['competitor3'],
            ];

            // Store competitors data as JSON in the project
            $project->competitors = json_encode($competitors);

            // Save the updated project
            $project->save();

            // Redirect with success message
            Flashy::mutedDark(' ✅ Competitors data updated successfully.', '#');
            return redirect()->route('advertiser.project.edit', base64_encode($project->id))
                ->with('success', 'Competitors data updated successfully.');
        } else {
            // Handle the case where the project is not found
            return redirect()->back()->with('error', 'Project not found.');
        }
    }

    // update project step4🌟
    public function updateStep3(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'keywords' => 'required|string',
            'trackkeywords' => 'required|array',
            'track_device' => 'required|string',
        ]);

        // Find the project by ID
        $project = Project::findOrFail($id);

        // Update the project's details
        $project->keywords = $validatedData['keywords'];
        $project->trackkeywords = json_encode($validatedData['trackkeywords']);
        $project->track_device = $validatedData['track_device'];

        // Save the updated project
        $project->save();

        // Redirect to the next step or a success page
        Flashy::mutedDark(' ✅ Updated Keywords successfully.', '#');
        return redirect()->route('advertiser.project.edit', base64_encode($project->id))
                ->with('success', 'Updated Keywords successfully.');
    }



    public function webList(Request $request)
    {
        $webQuery = Website::query();

        // Filter by website_status == "approve"
        $webQuery->where('website_status', 'approve');

        if ($request->query('audience')) {
            $webQuery->where('audience', 'like', "%" . $request->query('audience') . "%");
        }
        if ($request->query('categories')) {
            $webQuery->where('categories', 'like', "%" . $request->query('categories') . "%");
        }
        if ($request->query('link_type')) {
            $webQuery->where('link_type', 'like', "%" . $request->query('link_type') . "%");
        }
        if ($request->query('min_price')) {
            $webQuery->where('normal_price', '>=', $request->query('min_price'));
        }
        if ($request->query('max_price')) {
            $webQuery->where('normal_price', '<=', $request->query('max_price'));
        }
        if ($request->query('sponsorship')) {
            $webQuery->where('sponsorship', 'like', "%" . $request->query('sponsorship') . "%");
        }
        if ($request->query('language')) {
            $webQuery->where('language', 'like', "%" . $request->query('language') . "%");
        }
        if ($request->query('search_query')) {
            $searchQuery = strtolower($request->query('search_query'));
            $webQuery->where(function ($query) use ($searchQuery) {
                $query->whereRaw('LOWER(web_url) LIKE ?', ["%{$searchQuery}%"])
                    ->orWhereRaw('LOWER(web_description) LIKE ?', ["%{$searchQuery}%"])
                    ->orWhereRaw('LOWER(audience) LIKE ?', ["%{$searchQuery}%"])
                    ->orWhereRaw('LOWER(categories) LIKE ?', ["%{$searchQuery}%"]);
            });
        }

        $website = $webQuery->get();
        return view('advertiser.website-list', compact('website'));
    }
}
