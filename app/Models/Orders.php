<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            ->join('dish', 'dish.dish_id', '=', 'orders.dish_id')
            ->select('orders.*',"users.*", 'users.Email','dish.*')
            ->get();
        return $orderList;
    }
    
    public function isDishConstrained($id)
    {
        $order = DB::table($this->table)
            ->select('orders.status', 'orders.dish_id')
            ->where('orders.dish_id', $id)
            ->first();
        return (!empty($order));
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