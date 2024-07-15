<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'buyer_id', 'auction_id', 'bid_price', 'status',
    ];

    // Relationships
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
