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
    public function getCategories()
    {
        $listCategories =  DB::table('category')
            ->select('category.*')
            ->get();
        return $listCategories;
    }
    public function addDish($dishName, $categoryId, $image, $detail, $price)
    {
        DB::table($this->table)->insert([
            'dish_name' => $dishName,
            'category_id' => $categoryId,
            'image_dish' => $image,
            'details' => $detail,
            'price' => $price
        ]);
    }
}