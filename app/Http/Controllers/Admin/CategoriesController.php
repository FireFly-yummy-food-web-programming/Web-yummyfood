<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    private $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function getAllCategories(Request $request)
    {
        $title = 'List of Orders';
        $listCategories = $this->categories->getAllCategories();
        return view('admin.dashboard.categories', compact('title', 'listCategories'));
    }
    public function getFormAddCategory(Request $request)
    {
        $title = "Add new Category";
        return view('admin.categories.add', compact('title'));
    }
    public function postAddCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:5',
        ], [
            'category_name.required' => 'Requires entering a category name',
            'category_name.min' => 'Full name must be :min characters or more',
        ]);

        $dataInsert = $request->category_name; //category_name là tên name trong for
        $this->categories->addCategory($dataInsert);
        return redirect()->route('manage-categories')->with('msg', 'Added category successfully');
    }
    public function deleteCategory($id = 0)
    {

        if (!empty($id)) {
            $userDetail = $this->categories->getCategoryDetail($id);
            if (!empty($userDetail[0])) {
                $deleteStatus = $this->categories->deleteCategory($id);
                if ($deleteStatus) {
                    $msg = "Delete category successfully";
                } else {
                    $msg = "You cannot delete this category";
                }
            } else {
                $msg = 'Category does not exist';
            }
        } else {
            $msg = 'Link does not exist';
        }
        return redirect()->route('manage-categories')->with('msg', $msg);
    }
    public function RestoreCategory($id)
    {
        $this->categories->RestoreCategory($id);
        return redirect()->route('manage-categories')->with('msg', "Restore category successful");
    }
}