<?php

namespace App\Http\Controllers;

use App\Models\AddCredit;
use Illuminate\Http\Request;

class AddCreditController extends Controller
{
    public function creditStore(Request $request) {
        // Validate the incoming request
        $request->validate([
            'amount' => 'required|integer',
            'coupon' => 'nullable|integer',
            'payment_method' => 'nullable',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();

        // Create a new AddCredit record
        AddCredit::create([
            'user_id' => $userId,
            'amount' => $request->amount,
            'coupon' => $request->coupon,
        ]);

        // Redirect to the bill detail page with a success message
        return redirect()->route('advertiser.bill.detail')->with('success', 'Your amount has been added successfully.');
    }

}
