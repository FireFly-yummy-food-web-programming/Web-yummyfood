<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Auction;
use App\Models\AuctionHistory;
use App\Models\Deposit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BuyerController extends Controller
{
    // Register a new buyer
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:buyers',
            'phone_number' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $buyer = Buyer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return response()->json(['message' => 'Account registered successfully', 'buyer' => $buyer], 200);
    }

    // Update an existing buyer's profile
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:buyers,email,' . $request->buyer_id,
            'phone_number' => 'sometimes|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $buyer = Buyer::find($request->buyer_id);

        if ($request->has('username')) {
            $buyer->username = $request->username;
        }
        if ($request->has('email')) {
            $buyer->email = $request->email;
        }
        if ($request->has('phone_number')) {
            $buyer->phone_number = $request->phone_number;
        }

        $buyer->save();

        return response()->json(['message' => 'Profile updated successfully', 'buyer' => $buyer], 200);
    }

    // Delete a buyer's profile
    public function deleteProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        Buyer::destroy($request->buyer_id);

        return response()->json(['message' => 'Profile deleted successfully'], 200);
    }

    // Reset password for a buyer
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:buyers,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Generate a new password or send a reset link
        // For simplicity, we'll assume the new password is sent via email
        $newPassword = Str::random(10);
        $buyer = Buyer::where('email', $request->email)->first();
        $buyer->password = Hash::make($newPassword);
        $buyer->save();

        // Here you would send the new password to the buyer's email
        // Mail::to($buyer->email)->send(new ResetPasswordMail($newPassword));

        return response()->json(['message' => 'Password reset link sent successfully'], 200);
    }
}
