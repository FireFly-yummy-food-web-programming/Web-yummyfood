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
    public function addToFavorites(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $dish_id = $request->id;
        $data = [
            'user_id' => $user_id,
            'dish_id' => $dish_id,
        ];
        $this->favorite->add($data);
        return back();
    }        
}