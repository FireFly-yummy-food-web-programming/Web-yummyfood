<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    public function isDishConstrained($id)
    {
        $order = DB::table($this->table)
            ->select('orders.status', 'order_detail.dish_id')
            ->join('orders', 'order_detail.order_id', '=', 'orders.order_id')
            ->where('order_detail.dish_id', $id)
            ->first();
        return (!empty($order));
    }
    
}