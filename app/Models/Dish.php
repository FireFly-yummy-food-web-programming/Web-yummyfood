<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dish extends Model
{
    use HasFactory;
    protected $table = 'dish';
    protected $primaryKey = 'dish_id';
    protected $fillable = ['category_id', 'image_dish', 'dish_name', 'details', 'price'];
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
    public function getImage($id)
    {
        return DB::table($this->table)
            ->select('image_dish')
            ->where('dish_id', $id)
            ->first();
    }
    public function addDish($data)
    {
        $dish = new Dish();
        $dish->dish_name = $data['dish_name'];
        $dish->category_id = $data['category_id'];
        $dish->image_dish = $data['image_dish'];
        $dish->details = $data['detail'];
        $dish->price = $data['price'];
        $dish->save();
    }
    public function getDishDetail($id)
    {
        return DB::table($this->table)
            ->select('dish.*')
            ->where('dish_id', '=', $id)
            ->get();
    }
    public function EditDish($id, $data)
    {
        DB::table($this->table)
            ->where('dish_id', $id)
            ->update([
                'dish_name' => $data['dish_name'],
                'category_id' => $data['category_id'],
                'price' => $data['price'],
                'details' => $data['detail'],
                'image_dish' => $data['image_dish'],
            ]);
    }


    public function deleteDish($id)
    {
        $dish = $this->findOrFail($id);
        $dish->delete();
        return $dish;
    }

    public function RestoreDish($id)
    {
        $dish = $this->withTrashed()->findOrFail($id);
        $dish->restore();
    }

}