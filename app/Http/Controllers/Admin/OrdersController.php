<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $orders;
    public function __construct()
    {
        $this->orders = new Orders();
    }
    public function getAllOrders(Request $request)
    {
        $title = 'List of Orders';
        $listOrders = $this->orders->getAllOrders();
        return view('admin.dashboard.orders', compact('title', 'listOrders'));
    }
}