<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Categoties extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    public function getAllCategories()
    {
        $categoryList = DB::select('SELECT * FROM category');
        // dd($dishList);
        return $categoryList;
    }
}