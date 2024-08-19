<?php

namespace App\Http\Controllers;

use App\Models\AddCredit;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class AddCreditController extends Controller
{
    public function creditStore(Request $request) {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|integer',
            'coupon' => 'nullable|integer',
            'payment_method' => [
                'required',
                'string',
                'in:Bank_Transfer,Stripe,PayPal' 
            ],
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Create a new AddCredit record
        AddCredit::create([
            'user_id' => $userId,
            'amount' => $request->amount,
            'coupon' => $request->coupon,
            'payment_method' => $request->payment_method,
        ]);
        Flashy::mutedDark(' ✅ Your amount has been added successfully. ', '#');
        return redirect()->route('advertiser.bill.detail')->with('success', 'Your amount has been added successfully.');
    }

}
