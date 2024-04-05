<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $listDish = DB::table('dish')->limit(10)->get();
        $allDish = DB::table('dish')->get();
        $listRandom =DB::table('dish')->inRandomOrder()->limit(10)->get();
        // dd($listDish);
        return view('clients.home',compact('listDish','allDish','listRandom'));
    }

    // public function sliderFood(){
    //     foreach
    // }

    


}
