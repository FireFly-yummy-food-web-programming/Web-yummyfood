<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Favorite;
class HomeController extends Controller
{
    public function index(Request $request)
{
    $listDish = DB::table('dish')->limit(10)->get();
    $allDish = DB::table('dish')->get();
    $listRandom = DB::table('dish')->inRandomOrder()->limit(10)->get();
    $listRandomPromotion = DB::table('dish')->where('discount', '>', 1)->inRandomOrder()->limit(10)->get(); 
    $listDishId = session()->get('favoriteId', []);
    // get banner
    $bigBanner = DB::table('banners')->get();
    //get category
    $category =DB::table('category')->get();

    if (session()->has('favoriteNewId')) {
        $favoriteNewId = session()->get('favoriteNewId');
        if (!in_array($favoriteNewId, $listDishId)) {
            $listDishId[] = $favoriteNewId; 
            session()->put('favoriteId', $listDishId); 
        }
    }
    return view('clients.home', compact('listDish', 'allDish', 'listRandom', 'listRandomPromotion', 'listDishId','bigBanner','category'));
}
    public function isFavorite($user_id, $dish_id){
        $isFavorite = DB::table('favorites')
                        ->where('user_id', $user_id)
                        ->where('dish_id', $dish_id)
                        ->exists();
        return $isFavorite;
    
    }

    
}
