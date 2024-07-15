<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'buyer_id', 'auction_id', 'amount',
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
