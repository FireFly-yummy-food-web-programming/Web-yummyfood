<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoties extends Model
{
    use HasFactory;
    protected $table = 'category';
    public function getAllCategories()
    {
        $categoryList = DB::table($this->table)
            ->select('category.*')
            ->get();
        return $categoryList;
    }
}
