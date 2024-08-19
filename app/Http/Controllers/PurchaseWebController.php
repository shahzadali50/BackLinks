<?php

namespace App\Http\Controllers;

use App\Models\AddCredit;
use App\Models\PurchaseWeb;
use Illuminate\Http\Request;

class PurchaseWebController extends Controller
{
    public function purchase_web(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'webId' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();
        // Calculate the total amount for the logged-in user
        $userAmount = AddCredit::where('user_id', $userId)->sum('amount');

    // Calculate the total amount spent by the user on previous purchases
    $totalSpent = PurchaseWeb::where('user_id', $userId)->sum('amount');
      // Calculate the remaining amount after previous purchases
      $remainingCredit = $userAmount - $totalSpent;

        if ($request->price <= $userAmount) {
            // Check if a record with the same web_id and user_id already exists
            $existingCredit = PurchaseWeb::where('web_id', $request->webId)
                ->where('user_id', $userId)
                ->first();

            if ($existingCredit) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already purchased this website',
                ], 400);
            } else {
                // Subtract the purchase amount from the user's credit
                $remainingAmount = $remainingCredit - $request->price;

                // Record the purchase
                PurchaseWeb::create([
                    'user_id' => $userId,
                    'amount' => $request->price,
                    'web_id' => $request->webId,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Purchase recorded successfully!',
                    'remainingAmount' => $remainingAmount,
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Please add Credit to purchase this website',
        ], 400);
    }


    public function puchaseWebList()
    {

        $userId = auth()->id();

        $purchaseWebList = PurchaseWeb::with('website')
            ->where('user_id', $userId)
            ->get();
        // return $purchaseWebList;
        // Extract websites from the purchases
        $websites = $purchaseWebList->pluck('website');

        return view('advertiser.website.purchase-web-list', compact('websites'));
    }
}
