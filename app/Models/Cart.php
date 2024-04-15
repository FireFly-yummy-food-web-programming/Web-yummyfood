<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    public function isCartConstrained($userId)
    {
        return $this->where('user_id', $userId)->exists();
    }
}