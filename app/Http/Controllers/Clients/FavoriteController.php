<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $dish_id = $id;
        $isFavorite = $this->favorite->isFavorite($user_id, $dish_id);
        if ($isFavorite) {
            $this->favorite
                ->where('user_id', $user_id)
                ->where('dish_id', $dish_id)
                ->delete();
            $favoriteId = $request->session()->get('favoriteId', []);
            $index = array_search($dish_id, $favoriteId);
            if ($index !== false) {
                unset($favoriteId[$index]);
            }
            $request->session()->put('favoriteId', $favoriteId);
        } else {
            $data = [
                'user_id' => $user_id,
                'dish_id' => $dish_id,
            ];
            $favorites = $this->favorite->addFavorite($data);
            $favoriteId = $request->session()->get('favoriteId', []);
            $favoriteId[] = $dish_id;
            $request->session()->put('favoriteId', $favoriteId);
        }

        return back();
    }

    public function getAllFavoriteOfUser(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $listDish = $this->favorite->listFavorite($user_id);
        return view('clients.listFavorite', compact('listDish'));
    }
}
