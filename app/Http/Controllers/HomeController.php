<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function index(Request $request){
        $listDish = DB::table('dish')->limit(10)->get();
        $allDish = DB::table('dish')->get();
        $listRandom =DB::table('dish')->inRandomOrder()->limit(10)->get();
        return view('clients.home',compact('listDish','allDish','listRandom'));
    } 
}