<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dish(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addFavorite($data)
    {
        $favorite = new Favorite();
        $favorite->user_id = $data['user_id'];
        $favorite->dish_id = $data['dish_id'];
        $favorite->save();
    }
    public function listFavorite($user_id){
        $favoriteDishes = DB::table('favorites')
                            ->join('dish', 'favorites.dish_id', '=', 'dish.dish_id')
                            ->where('favorites.user_id', $user_id)
                            ->select('dish.*')
                            ->get();    
        return $favoriteDishes;
    }
    public function isFavorite($user_id, $dish_id){
        $isFavorite = DB::table('favorites')
                        ->where('user_id', $user_id)
                        ->where('dish_id', $dish_id)
                        ->exists();
        return $isFavorite;
    }
}   