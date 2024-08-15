<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class AdminController extends Controller
{
    public function user_list(Request $request)
    {
        $userQuery = User::query();
        $userQuery = User::where(function ($query) {
            $query->where('role', 'advertiser')
                  ->orWhere('role', 'publisher');
        });
            if($request->query('role')){
                $userQuery->where('role', 'like', "%" . $request->query('role') . "%");

            }
            $users = $userQuery->get();
        return view('admin.user.list', compact('users'));
    }
    public function user_detail($encodedId)
    {
        $userId = base64_decode($encodedId);
        $user = User::findOrFail($userId);
        // return $user;

        return view('admin.user.user-detail', compact('user'));
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User has been successfully deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong while deleting the user.']);
        }
    }
    public function website_list( Request $request)
    {

        $webQuery = Website::query();

        // Filter by website_status == "approve"
        // $webQuery->where('website_status', 'approve');

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
            $webQuery->where(function($query) use ($searchQuery) {
                $query->whereRaw('LOWER(web_url) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(web_description) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(audience) LIKE ?', ["%{$searchQuery}%"])
                      ->orWhereRaw('LOWER(categories) LIKE ?', ["%{$searchQuery}%"]);
            });
        }

        $websites = $webQuery->get();
        return view('admin.websites.list', compact('websites'));
    }
    public function website_detail($encodedId)
    {
        $websiteId = base64_decode($encodedId);

        $website = Website::find($websiteId);
        // return $website;
        return view('admin.websites.website-detail', compact('website'));
    }
    public function website_approve()
    {
        $websites = Website::with('user')->where('website_status', 'approve')->get();
        return view('admin.websites.website-approve', compact('websites'));
    }
    public function website_pending()
    {
        $websites = Website::with('user')->where('website_status', 'pending')->get();
        return view('admin.websites.website-pending', compact('websites'));
    }
    public function website_rejected()
    {
        $websites = Website::with('user')->where('website_status', 'rejected')->get();
        return view('admin.websites.website-rejected', compact('websites'));
    }
    public function change_status(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:websites,id',
            'status' => 'required|string|in:pending,approve,rejected',
        ]);

        $site = Website::find($validated['id']);
        if ($site) {
            $site->website_status = $validated['status'];
            $site->save();

            return response()->json(['msg' => 'Status updated successfully.']);
        }

        return response()->json(['msg' => 'Failed to update status.'], 400);
    }
}
