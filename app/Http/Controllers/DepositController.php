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

class DepositController extends Controller
{
    // Place a deposit for an auction
    public function placeDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'auction_id' => 'required|exists:auctions,id',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $deposit = Deposit::create([
            'buyer_id' => $request->buyer_id,
            'auction_id' => $request->auction_id,
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Deposit placed successfully', 'deposit' => $deposit], 200);
    }

}
