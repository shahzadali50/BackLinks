<?php

namespace App\Http\Controllers;

use App\Models\AddCredit;
use App\Models\PurchaseWeb;
use Illuminate\Http\Request;

class PurchaseWebController extends Controller
{
    public function purchase_web(Request $request)
    {
        // return $request;
        // Validate the incoming request data
        $validated = $request->validate([
            'webId' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Get the authenticated user's ID
        $userId = auth()->id();
        // Calculate the total amount for the logged-in user
        $userAmount = AddCredit::where('user_id', $userId)->sum('amount');
        if ($request->price <= $userAmount) {
            // Check if a record with the same web_id and user_id already exists
            $existingCredit = PurchaseWeb::where('web_id', $request->webId)
                ->where('user_id', $userId)
                ->first();


            if ($existingCredit) {
                // Return a JSON response indicating that the record already exists
                return response()->json([
                    'success' => false,
                    'message' => 'You have already purchased this website',
                ], 400); // 400 Bad Request
            } else {
                // Create a new record in the add_credits table
                $addCredit = PurchaseWeb::create([
                    'user_id' => $userId,
                    'amount' => $request->price,
                    'web_id' => $request->webId,
                ]);

                // Return a JSON response
                return response()->json([
                    'success' => true,
                    'message' => 'Purchase recorded successfully!',
                ]);
            }
        }
        // Return a JSON response indicating insufficient credit
        return response()->json([
           'success' => false,
           'message' => 'Please add Credit to purchase this website ',
        ], 400); // 403 Forbidden
    }
}
