<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dish extends Model
{
    use HasFactory;
    protected $table = 'dish';
    public function getAllDish()
    {
        $dishList = DB::table($this->table)
            ->join('category', 'category.category_id', '=', 'dish.category_id')
            ->select('dish.*', 'category.category_name')
            ->get();
        return $dishList;
    }
}
