<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Website;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    public function list(){
        $user = auth()->user();
        // Fetch projects associated with the logged-in user using where condition
        $projects = Project::where('user_id', $user->id)->get();
        return view('advertiser.project.list', compact('projects'));

    }
    public function projectStep1(){
        return view('advertiser.project.project-step1');
    }
    public function projectStep2(){
        if (!Session::has('project_step1')) {
            // Flashy::warning('🔄 Please complete all previous steps ', '#');
            return redirect()->route('advertiser.projectStep1')
                ->with('error', 'Please complete all previous steps.');
        }
        return view('advertiser.project.project-step2');
    }
    public function projectStep3(){
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
            'url_website' => 'required|url',
            'categories' => 'required|array',
            'language' => 'required|array',
            'countries' => 'required|array',
            'objectives' => 'required|array',
        ]);

        $request->session()->put('project_step1', $request->only([
            'project_name', 'url_website', 'categories', 'language', 'countries', 'objectives'
        ]));
        Flashy::mutedDark(' ✅ Step 1: Data has been saved successfully. ', '#');

        return redirect()->route('advertiser.projectStep2')->with('success', 'Step 1: Data has been saved successfully.');
    }
    public function storeStep2(Request $request){
        $request->validate([
            'competitor1' => 'nullable|url|different:competitor2|different:competitor3',
            'competitor2' => 'nullable|url|different:competitor1|different:competitor3',
            'competitor3' => 'nullable|url|different:competitor1|different:competitor2',
        ]);

        Session::put('project_step2', $request->only(['competitor1', 'competitor2', 'competitor3']));
        Flashy::mutedDark(' ✅ Step 2: Data has been saved successfully. ', '#');
        return redirect()->route('advertiser.projectStep3')->with('success', 'Step 2: Data has been saved successfully.');
    }
    public function storeStep3(Request $request){
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
        $project->url = $step1Data['url_website'];
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
    public function projectDelete($id){
        $website = Project::find($id);
        if($website){
            $website->delete();
            Flashy::mutedDark('✅ Project information has been successfully deleted.', '#');
            return redirect()->route('advertiser.project.list')->with('delete', 'Project information has been successfully deleted.');
        }else{
            Flashy::warning('�� Something went wrong while deleting the website.', '#');
            return redirect()->route('advertiser.project.list')->with('error', 'Something went wrong while deleting the website.');
        }

    }

    public function webList(Request $request){
        $webQuery = Website::query();
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
        if ($request->query('search_query')) {
            $searchQuery = strtolower($request->query('search_query'));
            $webQuery->where(function($query) use ($searchQuery) {
                $query->whereRaw('LOWER(web_url) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(web_description) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(audience) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(categories) LIKE ?', ["%{$searchQuery}%"]);
            });
        }


        // $website=Website::all();
        $website = $webQuery->get();
        return view('advertiser.website-list',compact('website'));
    }
}
