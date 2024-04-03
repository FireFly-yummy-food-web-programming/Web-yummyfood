<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use  App\Models\Contacts;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function isUserConstrained($userId)
    {
        $order = DB::table($this->table)->where('user_id', $userId)->first();
        return !empty($order);
    }

    public function getAllOrders()
    {
        $orderList = DB::table($this->table)
            ->join('users', 'orders.user_id', '=', 'users.user_id')
            ->join('order_detail', 'order_detail.order_id', '=', 'orders.order_id')
            ->select('orders.*', 'users.Username', 'users.Email', 'order_detail.*')
            ->get();
        // dd($orderList);
        return $orderList;
    }

    public function getOrderStatusByUserId($userId)
    {
        $order = DB::table($this->table)
            ->where('user_id', $userId)
            ->first();

        if ($order) {
            return $order->status;
        }

        return null;
    }
    public function updateStatus($orderId, $newStatus)
    {
        Orders::where('order_id', $orderId)->update(['status' => $newStatus]);
    }
}