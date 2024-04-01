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
            'category_name' => 'required',
        ], [
            'category_name.required' => 'Requires entering a category name',
        ]);
        $dataInsert = [
            'category_name' => $request->input('category_name')
        ];
        $this->categories->addCategory($dataInsert);
        return redirect()->route('manage-categories')->with('msg', 'Added category successfully');
    }
    public function deleteCategory($id = 0)
    {

        if (!empty($id)) {
            $categoryDetail = $this->categories->getCategoryDetail($id);
            if (!empty($categoryDetail[0])) {
                $deleteStatus = $this->categories->deleteCag($id);
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
        $this->categories->RestoreCag($id);
        return redirect()->route('manage-categories')->with('msg', "Restore category successful");
    }
    public function getFormEditCategory(Request $request, $id = 0)
    {
        $title = "Edit Category";
        if (!empty($id)) {
            $categoryDetail = $this->categories->getCategoryDetail($id);
            if (!empty($categoryDetail[0])) {
                $request->session()->put('category_id', $id);
                $categoryDetail = $categoryDetail[0];
            } else {
                return redirect()->route('manage-categories')->with('msg', 'This category does not exist');
            }
        } else {
            return redirect()->route('manage-categories')->with('msg', 'Link does not exist');
        }
        return view('admin.categories.edit', compact('title', 'categoryDetail'));
    }
    public function postEditCategory(Request $request)
    {
        $id = session('category_id');
        if (empty($id)) { {
                return back()->with('msg', 'Link does not exist');
            }
        }
        $request->validate([
            'category_name' => 'required',
        ], [
            'category.required' => 'Category name is required',
        ]);
        $category_name = $request->category_name;
        $updated_at = now();
        $this->categories->EditCag($id, $category_name, $updated_at);
        return back()->with('msg', 'Updated directory successfully');
    }
}