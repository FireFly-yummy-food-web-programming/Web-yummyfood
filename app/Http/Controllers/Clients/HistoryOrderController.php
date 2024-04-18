<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HistoryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = session()->get('user_id');
        $listDish = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.user_id')
                ->join('dish', 'dish.dish_id', '=', 'orders.dish_id')
                ->select('orders.*', 'users.user_id', 'users.Username', 'users.Email', 'dish.*')
                ->where('orders.user_id', $user_id)
                ->get();
        // dd($listDish);
        return view('clients.historyOrders', compact('listDish'));
    }

}
