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

    protected $fillable = [
        'user_id', // ID của người dùng
        'dish_id', // ID của sản phẩm trong giỏ hàng
        // Các trường khác nếu cần
    ];

    // Quan hệ với bảng Users (mỗi giỏ hàng thuộc về một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bảng Dishes (mỗi sản phẩm trong giỏ hàng)
    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}