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
    public function getAllCategories()
    {
        $categoryList = DB::table($this->table)
            ->select('category.*')
            ->get();
        return $categoryList;
    }
    public function addCategory($data)
    {
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->save();
    }
    public function getCategoryDetail($id)
    {
        return DB::table($this->table)
            ->select('category.*')
            ->where('category_id', '=', $id)
            ->get();
    }
    public function deleteCag($id)
    {
        $category = $this->findOrFail($id);
        $category->delete();
    }
    public function RestoreCag($id)
    {
        $category = $this->withTrashed()->findOrFail($id);
        $category->restore();
    }
    public function EditCag($id, $category_name, $updated_at)
    {
        DB::table($this->table)
            ->where('category_id', $id)
            ->update([
                'category_name' => $category_name,
                'updated_at' => $updated_at
            ]);
    }
}
