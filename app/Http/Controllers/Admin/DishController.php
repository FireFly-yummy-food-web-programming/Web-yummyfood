<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Dish;

class DishController extends Controller
{
    private $dishs;
    public function __construct()
    {
        $this->dishs = new Dish();
    }
    public function getDish(Request $request){
        $title = 'List of dishes';
        $listDish = $this->dishs->getAllDish();
        return view('admin.dashboard.dishs', compact('title', 'listDish'));
    }

    public function getDetail($id)
    {
        $dish = Dish::findOrFail($id);
        return view('clients.detail', compact('dish'));
    }
}