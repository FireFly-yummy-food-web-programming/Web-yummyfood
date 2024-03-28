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
        // dd($listDish);
        return view('admin.dashboard.dishs', compact('title', 'listDish'));
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
            'category_id' => 'required',
            'image_dish' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'detail' => 'required',
        ], [
            'dish_name.required' => 'Requires entering a dish name',
            'dish_name.unique' => 'The dish name already exists',
            'category_id.required' => 'Requires entering a category name',
            'image_dish.required' => 'Requires uploading a dish image',
            'image_dish.image' => 'The file is not in the correct format',
            'image_dish.mimes' => 'The file is not in the correct format',
            'price.required' => 'Requires entering a dish price',
            'price.numeric' => 'Invalid price',
            'detail.required' => 'Requires entering a dish detail',
        ]);

        $category_id = $request->category_id;
        $price = $request->price;
        $detail = $request->detail;

        // Kiểm tra xem tệp đã được tải lên chưa
        $fileName = $request->file('image_dish')->getClientOriginalName();
        $request->file('image_dish')->storeAs('images', $fileName, 'public');
        $dish = [
            'dish_name' =>  $request->input('dish_name'),
            'category_id' => $category_id,
            'price' => $price,
            'detail' => $detail,
            'image_dish' => $fileName,
        ];
        $this->dishs->addDish($dish);
        return redirect()->route('add-dish')->with('msg', 'Added dish successfully');
    }

    public function getFormEditdish(Request $request, $id = 0)
    {
        $title = "Edit dish";
        if (!empty($id)) {
            $dishDetail = $this->dishs->getdishDetail($id);
            $listCategories = $this->dishs->getCategories();
            if (!empty($dishDetail[0])) {
                $request->session()->put('dish_id', $id);
                $dishDetail = $dishDetail[0];
            } else {
                return redirect()->route('manage-dish')->with('msg', 'This dish does not exist');
            }
        } else {
            return redirect()->route('manage-dish')->with('msg', 'Link does not exist');
        }
        // dd($dishDetail);
        return view('admin.dish.edit', compact('title', 'dishDetail', 'listCategories'));
    }
    public function postEditdish(Request $request)
    {
        $id = session('dish_id');
        $oldImage = $this->dishs->getImage($id);
        if (empty($id)) { {
                return back()->with('msg', 'Link does not exist');
            }
        }
        $request->validate([
            'dish_name' => 'required|unique:dish,dish_name',
            'category_id' => 'required',
            'image_dish' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'detail' => 'required',
        ], [
            'dish_name.required' => 'Requires entering a dish name',
            'category_id.required' => 'Requires entering a category name',
            'image_dish.image' => 'The file is not in the correct format',
            'image_dish.mimes' => 'The file is not in the correct',
            'price.required' => 'Requires entering a dish price',
            'price.numeric' => 'Invalid price',
            'detail.required' => 'Requires entering a dish detail',
        ]);
        $dish = [
            'dish_name' =>  $request->input('dish_name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'detail' => $request->input('detail'),
        ];
        if ($request->hasFile('image_dish')) {
            $imageName = $request->file('image_dish') . '.' . $request->image->extension();
            $request->file('image')->storeAs('images', $imageName, 'public');
            $dish['image_dish'] = $imageName;
        } else {
            $dish['image_dish'] = $oldImage->image_dish;
        }
        // dd($dish);
        $this->dishs->EditDish($id, $dish);
        return back()->with('msg', 'Updated directory successfully');
    }




    public function deleteDish($id = 0)
    {

        if (!empty($id)) {
            $dishDetail = $this->dishs->getdishDetail($id);
            if (!empty($dishDetail[0])) {
                $deleteStatus = $this->dishs->deleteDish($id);
                if ($deleteStatus) {
                    $msg = "Delete dish successfully";
                } else {
                    $msg = "You cannot delete this dish";
                }
            } else {
                $msg = 'dish does not exist';
            }
        } else {
            $msg = 'Link does not exist';
        }
        return redirect()->route('manage-dishs')->with('msg', $msg);
    }
}
