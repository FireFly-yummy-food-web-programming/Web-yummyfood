<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
class HomeController extends Controller
{
    private $favorite;
    public function __construct()
    {
        $this->favorite = new Favorite();
    }
    public function index(Request $request){

        $listDish = DB::table('dish')->limit(10)->get();
        $allDish = DB::table('dish')->get();
        $listRandom =DB::table('dish')->inRandomOrder()->limit(10)->get();
        $user_id = $request->session()->get('user_id');
        $dish_id = $request->id;
        $isFavoritedDish = $this->favorite->isFavorited($user_id, $dish_id);
        // dd($isFavoritedDish);
        return view('clients.home',compact('listDish','allDish','listRandom','isFavoritedDish'));
    }

    // public function sliderFood(){
    //     foreach
    // }

    


}