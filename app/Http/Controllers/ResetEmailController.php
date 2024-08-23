<?php

namespace App\Http\Controllers;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ResetEmailController extends Controller
{
    public function reset_email_address(){
        return view('reset-email.index');

    }

    public function updateEmailRequest(Request $request)
    {
        // Get the current user
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'old_email' => 'required|email',
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

        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Store the OTP in the session
        session(['email_update_otp' => $otp]);

        // Send the OTP to the user's email
        Mail::to($user->email)->send(new SendOtpMail($otp));
        if ($user->role === 'advertiser') {
            // Flashy::mutedDark(' ✅An OTP has been sent to your email.', '#');
            return redirect()->route('advertiser.reset.email.address')->with('success', 'An OTP has been sent to your email.');
        } elseif ($user->role === 'admin') {
            // Flashy::mutedDark(' ✅An OTP has been sent to your email.', '#');
            return redirect()->route('admin.reset.email.address')->with('success', 'An OTP has been sent to your email.');
        } else {
            // Flashy::mutedDark(' ✅An OTP has been sent to your email.', '#');
            return redirect()->route('publishers.reset.email.address')->with('success', 'An OTP has been sent to your email.');
        }
    }
    public function verify_email_otp(Request $request)
    {
        // Get the current user
        $user = Auth::user();

        // Validate the request
        $validator = Validator::make($request->all(), [
            'email_code' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the OTP matches the one in the session
        if ($request->email_code != session('email_update_otp')) {
            return back()->withErrors(['email_code' => 'The OTP code is incorrect.']);
        }

        // Update the user's email
        $user->email = $request->email;
        $user->save();

        // Clear the OTP from the session
        session()->forget('email_update_otp');

        return redirect()->route('advertiser.ProfileSetting')->with('success', 'Your email has been updated successfully.');



}
}
