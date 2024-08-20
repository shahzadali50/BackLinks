<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\AddCredit;
use App\Models\FavouriteWeb;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        // $user = Auth::user();

        // if ($user) {
        //     if ($user->role === 'publisher') {
        //         return redirect()->route('publishers.dashboard');
        //     } elseif ($user->role === 'advertiser') {
        //         return redirect()->route('advertiser.dashboard'); // or any other route for advertisers
        //     }
        // }

        return view('index');
    }

    public function checkAccount()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'publisher') {
                return redirect()->route('publishers.dashboard');
            } elseif ($user->role === 'advertiser') {
                return redirect()->route('advertiser.dashboard'); // or any other route for advertisers
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // or any other route for advertisers
            }
        }

        return view('index');
    }

    public function dashboard()
    {
        return view('publishers.dashboard');
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function ContactSupport()
    {
        return view('publishers.contact-support');
    }
    public function ProfileSetting()
    {
        return view('profile_setting.index');
    }
    public function website(Request $request)
    {

    // Retrieve the currently authenticated user
    $user = auth()->user();

    // Start building the query with the user's websites
    $webQuery = Website::where('user_id', $user->id);

    // Apply filters based on request parameters
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

    // Execute the query and get the results
    $website = $webQuery->get();

        return view('publishers.website.index', compact('website'));
    }
    public function exploreNow()
    {
        return view('publishers.nft.explore');
    }
    public function membership()
    {
        return view('publishers.membership');
    }
    public function transactions()
    {
        return view('publishers.payments.transactions');
    }
    public function billing()
    {
        return view('publishers.payments.billing');
    }
    public function list()
    {
        return view('publishers.support-tickets.list');
    }
    public function chat()
    {
        return view('chat');
    }
    public function sponsoredList()
    {
        return view('publishers.sponsored.list');
    }
    public function advertiserDashboard()
    {

        // Pass the records and the total amount to the view
        return view('advertiser.dashboard');
    }

    public function wallet()
    {
        $userId=Auth::user()->id;
        $totalAmount = AddCredit::where('user_id', $userId)->sum('amount');
        $creditDetail = AddCredit::where('user_id', $userId)  ->orderBy('created_at', 'desc')->get();

        return view('advertiser.wallet', compact('totalAmount','creditDetail'));
    }
    // public function list(){
    //     return view('advertiser.project.list');

    // }
    public function projectStep1()
    {
        return view('advertiser.project.project-step1');
    }
    public function projectStep2()
    {
        return view('advertiser.project.project-step2');
    }
    public function projectStep3()
    {
        return view('advertiser.project.project-step3');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the old password matches the current user's password
        if (!Hash::check($request->password, Auth::user()->password)) {
            Flashy::error(' ❌The provided password does not match your current password.', '#');
            return back()->withErrors(['password' => 'The provided password does not match your current password.']);
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);
        Flashy::mutedDark(' ✅Password updated successfully. ', '#');


        return back()->with('success', 'Password updated successfully.');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_img')) {
            // Delete the old profile image if it exists
            if ($user->profile_img) {
                Storage::delete('public/profile_images/' . $user->profile_img);
            }

            // Store the new profile image
            $imageName = time() . '.' . $request->profile_img->extension();
            $request->profile_img->storeAs('public/profile_images', $imageName);

            // Update the user's profile_img field
            $user->profile_img = $imageName;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        // Get the current user
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'old_email' => 'required|email',
            'new_email' => [
                'required',
                'email',
                'different:old_email',
                'unique:users,email,' . $user->id
            ],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the old email matches the user's current email
        if ($user->email !== $request->old_email) {
            Flashy::error(' ❌The provided email does not match your current email address.', '#');
            return back()->withErrors(['old_email' => 'The provided email does not match your current email address.']);
        }

        // Update the user's email
        $user->update([
            'email' => $request->new_email
        ]);

        // Optionally, you may want to log out the user or send a confirmation email
        Flashy::mutedDark(' ✅Email updated successfully.', '#');
        return back()->with('success', 'Email updated successfully.');
    }

    public function updateNamePhoneCountry(Request $request)
    {

        // return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        // Update or create the user details
        $user->updateOrCreate(
            ['id' => $user->id], // Attributes to find the existing record
            [
                'name' => $request->name,
                'phone_number' => $request->phone_number ?? $user->phone_number,
                'country' => $request->country ?? $user->country,
            ]
        );

        Flashy::mutedDark('  ✅User Detail Added successfully.', '#');

        return redirect()->back()->with('success', 'User Detail Added successfully.');
    }


    public function billDetail()
    {
        return view('advertiser.bill-detail.index');
    }
    public function KYC()
    {
        return view('kyc.index');
    }

    public function addFavouriteWeb(Request $request)
    {
        $request->validate([
            'fileId' => 'required|exists:websites,id',
        ]);

        $userId = Auth::id();
        $websiteId = $request->fileId;

        // Check if the favorite snippet already exists
        $existingFavourite = FavouriteWeb::where('user_id', $userId)
            ->where('website_id', $websiteId)
            ->first();

        if ($existingFavourite) {
            // If it exists, delete it
            $existingFavourite->delete();
            return response()->json(['success' => true, 'message' => 'Website removed from favourite']);
        }
        else {
            // If it does not exist, create it
            FavouriteWeb::create([
                'user_id' => $userId,
                'website_id' => $websiteId,
            ]);
            return response()->json(['success' => true, 'message' => 'Website added to favourite']);
        }
    }
    public function favouriteWeb()
    {
        $userId = Auth::id();
        $favouriteWebsites = FavouriteWeb::with('website')
            ->where('user_id', $userId)
            ->get();

        return view('advertiser.favourite-website', compact('favouriteWebsites'));
    }
}
