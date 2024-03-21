<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Categories;
use App\Models\Categoties;

class CategoriesController extends Controller
{
    private $categories;
    public function __construct()
    {
        $this->categories = new Categoties();
    }
    public function getAllCategories(Request $request)
    {
        $title = 'List of Orders';
        $listCategories = $this->categories->getAllCategories();
        return view('admin.dashboard.categories', compact('title', 'listCategories'));
    }
}