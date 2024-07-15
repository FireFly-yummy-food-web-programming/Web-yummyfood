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

class AuctionsController extends Controller
{
    // Retrieve a list of available auctions
    public function getAuctions()
    {
        $auctions = Auction::all();
        return response()->json(['auctions' => $auctions], 200);
    }

    // Retrieve a list of auctions the buyer has participated in
    public function getAuctionHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $auctionHistory = AuctionHistory::where('buyer_id', $request->buyer_id)->get();
        return response()->json(['auction_history' => $auctionHistory], 200);
    }
}
