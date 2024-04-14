<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        //pick data dish
        $listDish = DB::table('dish')->limit(10)->get();
        $allDish = DB::table('dish')->get();
        $listRandom =DB::table('dish')->inRandomOrder()->limit(10)->get();
        // dd($listDish);
        $category =DB::table('category')->get();

        //pick list banners
        $bigBanner = DB::table('banners')->get();

        return view('clients.home',compact('listDish','allDish','listRandom','category','bigBanner'));
    }

    // public function sliderFood(){
    //     foreach
    // }

    


}
