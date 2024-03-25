<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Dish;

class DishController extends Controller
{
    private $dishs;
    public function __construct()
    {
        $this->dishs = new Dish();
    }
    public function getDish(Request $request)
    {
        $title = 'List of dishes';
        $listDish = $this->dishs->getAllDish();
        return view('admin.dashboard.dishs', compact('title', 'listDish'));
        // dd($listCategories);
    }
    public function getFormAdddish()
    {
        $title = "Add new Dish";
        $listCategories = $this->dishs->getCategories();
        return view('admin.dish.add', compact('title', 'listCategories'));
    }
    public function postAdddish(Request $request)
    {
        $request->validate([
            'dish_name' => 'required|unique:dish,dish_name',
            'category_name' => 'required',
            'image_dish' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'detail' => 'required',
        ], [
            'dish_name.required' => 'Requires entering a dish name',
            'dish_name.unique' => 'The dish name already exists',
            'category-name.required' => 'Requires entering a category name',
            'image_dish.required' => 'Requires entering a dish image',
            'image_dish.image' => 'The file is not in the correct format',
            'image_dish.mimes' => 'The file is not in the correct',
            'price.required' => 'Requires entering a dish price',
            'price.numeric' => 'Invalid price',
            // 'price.min' => 'Invalid price',
            'detail.required' => 'Requires entering a dish detail',
        ]);
    
        $dish_name =  $request->dish_name;
        $category_id = $request->category_name;
        $price = $request->price;
        $detail =   $request->detail;
        $fileName = $request->file('image_dish')->getClientOriginalName();
        $request->file('image_dish')->storeAs('assets/images', $fileName);        
        $this->dishs->addDish($dish_name, $category_id, $fileName, $detail, $price);
        return redirect()->route('manage-categories')->with('msg', 'Added dish successfully');
    }
    
}