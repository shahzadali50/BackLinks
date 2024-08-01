<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(){
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

    public function checkAccount(){
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




    public function dashboard(){
        return view('publishers.dashboard');
    }
    public function ContactSupport(){
        return view('publishers.contact-support');
    }
    public function ProfileSetting(){
        return view('publishers.profile-setting');
    }
    public function website(){
        $user = auth()->user();

        $website=Website::where('user_id', $user->id)->get();

        return view('publishers.website.index',compact('website'));
    }
    public function exploreNow(){
        return view('publishers.nft.explore');
    }
    public function membership(){
        return view('publishers.membership');
    }
    public function transactions(){
        return view('publishers.payments.transactions');
    }
    public function billing(){
        return view('publishers.payments.billing');
    }
    public function list(){
        return view('publishers.support-tickets.list');
    }
    public function chat(){
        return view('publishers.chat');
    }
    public function sponsoredList(){
        return view('publishers.sponsored.list');
    }
    public function advertiserDashboard(){
        return view('advertiser.dashboard');
    }
    public function wallet(){
        return view('advertiser.wallet');
    }
    // public function list(){
    //     return view('advertiser.project.list');

    // }
    public function projectStep1(){
        return view('advertiser.project.project-step1');
    }
    public function projectStep2(){
        return view('advertiser.project.project-step2');
    }
    public function projectStep3(){
        return view('advertiser.project.project-step3');
    }


}
