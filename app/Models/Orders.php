<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public function getAllOrders()
    {
        $orderList = DB::table($this->table)
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->select('orders.*', 'users.Username', 'users.Email', 'order_detail.*')
            ->get();
        // dd($dishList);
        return $orderList;
    }
}