<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'Dish';
    public function getAllDish(){
        $dishList = DB::select('SELECT dish.*, category.category_name
        FROM dish
        INNER JOIN category
        ON dish.category_id = category.category_id;');
        // dd($dishList);
        return $dishList;
    }
}