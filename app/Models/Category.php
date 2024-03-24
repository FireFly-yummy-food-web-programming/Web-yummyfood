<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $dates = ['deleted_at'];
    public function getAllCategories()
    {
        $categoryList = DB::table($this->table)
            ->select('category.*')
            ->get();
        return $categoryList;
    }
    public function addCategory($category_name)
    {
        $category = DB::table($this->table)->insert([
            'category_name' => $category_name
        ]);
        return $category;
    }
    public function getCategoryDetail($id)
    {
        return DB::table($this->table)
            ->select('category.*')
            ->where('category_id', '=', $id)
            ->get();
    }
    public function deleteCategory($id)
    {
        $category = $this->findOrFail($id);
        $category->delete();
        return redirect()->route('manage-categories');
    }
    public function RestoreCategory($id)
    {
        $category = $this->withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('manage-categories');
    }
}