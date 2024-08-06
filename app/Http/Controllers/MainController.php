<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\FavouriteWeb;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            }
        }

        return view('index');
    }




    public function dashboard()
    {
        return view('publishers.dashboard');
    }
    public function ContactSupport()
    {
        return view('publishers.contact-support');
    }
    public function ProfileSetting()
    {
        return view('publishers.profile-setting');
    }
    public function website()
    {
        $user = auth()->user();

        $website = Website::where('user_id', $user->id)->get();

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
        return view('advertiser.dashboard');
    }
    public function wallet()
    {
        return view('advertiser.wallet');
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
            return back()->withErrors(['password' => 'The provided password does not match your current password.']);        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);
        Flashy::mutedDark(' ✅Password updated successfully. ', '#');


        return back()->with('success', 'Password updated successfully.');
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


    public function billDetail(){
        return view('advertiser.bill-detail.index');

    }
    public function KYC(){
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
        } else {
            // If it does not exist, create it
            FavouriteWeb::create([
                'user_id' => $userId,
                'website_id' => $websiteId,
            ]);
            return response()->json(['success' => true, 'message' => 'Website added to favourite']);
        }
    }
    public function favouriteWeb(){
        $userId = Auth::id();
        $favouriteWebsites = FavouriteWeb::with('website')
            ->where('user_id', $userId)
            ->get();

        return view('advertiser.favourite-website', compact('favouriteWebsites'));

    }
}
