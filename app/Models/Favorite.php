<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    
    public function add($data)
    {
        $favorite = new Favorite();
        $favorite->user_id = $data['user_id'];
        $favorite->dish_id = $data['dish_id'];
        $favorite->save();
    }
    public function getAllFavoriteListOfUser($user_id){
        $listFavorites = DB::table($this->table)->where('user_id', $user_id)
        ->join('dish', 'dish.dish_id', '=', 'favorites.dish_id')
        ->get();
    }
    public function isFavorited($user_id, $dish_id){
        $isFavorited = DB::table($this->table)
        ->where('user_id', $user_id)
        ->where('dish_id', $dish_id)
        ->exists();
        return $isFavorited;
    }
}   