<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    public function getAllOrders()
    {
        $orderList = DB::select('SELECT orders.*, users.Username, users.Email, order_detail.*
        FROM orders
                INNER JOIN users
                ON orders.user_id = users.user_id
                INNER JOIN order_detail
                ON orders.order_id = order_detail.order_id;');
        // dd($dishList);
        return $orderList;
    }
}