<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'password', 'email', 'phone_number',
    ];

    // Relationships
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function auctionHistories()
    {
        return $this->hasMany(AuctionHistory::class);
    }
}
