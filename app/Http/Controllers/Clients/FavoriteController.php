<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Redis;

class FavoriteController extends Controller
{
    private $favorite;
    public function __construct()
    {
        $this->favorite = new Favorite();
    }

    public function addToFavorite(Request $request, $id)
    {
        $user_id = $request->session()->get('user_id');
        $dish_id = $request->id;
        $isFavorite = Favorite::where('user_id', $user_id)->where('dish_id', $dish_id)->first();
        if ($isFavorite) {
            $isFavorite->delete();
            return redirect()->route('home')->with('isFavorite');
        } else {
            $data = [
                'user_id' => $user_id,
                'dish_id' => $dish_id,
            ];
            $favorites = $this->favorite->addFavorite($data);
            return redirect()->route('home')->with('isFavorite');
        }
    } 

    public function getAllFavoriteOfUser(Request $request){
        $user_id = $request->session()->get('user_id');
        $listDish = $this->favorite->listFavorite($user_id);
        // dd($listDish);
        return view('clients.listFavorite', compact('listDish'));
    }
}