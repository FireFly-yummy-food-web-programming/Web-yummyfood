<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Favorite;
class HomeController extends Controller
{
    public function index(Request $request){
        $listDish = DB::table('dish')->limit(10)->get();
        $allDish = DB::table('dish')->get();
        $listRandom =DB::table('dish')->inRandomOrder()->limit(10)->get();
        // dd($listDish);
        $listRandomPromotion = DB::table('dish')->where('discount', '>', 1)->inRandomOrder()->limit(10)->get();
        return view('clients.home', compact('listDish', 'allDish', 'listRandom', 'listRandomPromotion'));
    }
    public function isFavorite($user_id, $dish_id){
        $isFavorite = DB::table('favorites')
                        ->where('user_id', $user_id)
                        ->where('dish_id', $dish_id)
                        ->exists();
        return $isFavorite;
    
    }

    
}
