<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Dish;
use App\Models\Orders;
use App\Models\Order_detail;

class DishController extends Controller
{
    private $dishs;
    private $order_detail;
    public function __construct()
    {
        $this->dishs = new Dish();
        $this->order_detail = new Order_detail();
    }
    public function getDish(Request $request)
    {
        $title = 'List of dishes';
        $listDish = $this->dishs->getAllDish();
        // dd($listDish);
        return view('admin.dashboard.dishs', compact('title', 'listDish'));
    }

    public function getDetail($id)
    {
        $dish = Dish::findOrFail($id);
        return view('clients.detail', compact('dish'));
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
    if (empty($id) || $oldImage === null) {
        return back()->with('msg', 'Link does not exist or old image not found');
    }

    $request->validate([
        'image_dish' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'price' => 'numeric',
    ],[
        'image_dish.image' => 'The file is not in the correct format',
        'image_dish.mimes' => 'The file is not in the correct format',
        'price.numeric' => 'Invalid price',
    ]);
    $dish = [
        'dish_name' =>  $request->input('dish_name'),
        'category_id' => $request->input('category_id'),
        'price' => $request->input('price'),
        'detail' => $request->input('detail'),
    ];

    if ($request->hasFile('image_dish')) {
        $imageName = $request->file('image_dish')->getClientOriginalName(); // Lấy tên gốc của file
        $imageName = time() . '_' . $imageName; // Thêm timestamp để tránh trùng tên
        $request->file('image_dish')->storeAs('images', $imageName, 'public');
        $dish['image_dish'] = $imageName;
    } else {
        $dish['image_dish'] = $oldImage->image_dish;
    }

    $this->dishs->EditDish($id, $dish);
    return back()->with('msg', 'Updated directory successfully');
}

    public function deleteDish($id = 0)
    {
        if (empty($id)) {
            $msg = 'Link does not exist';
            return redirect()->route('manage-dish')->with('msg', $msg);
        }
        $dishDetail = $this->dishs->getdishDetail($id);
        if (empty($dishDetail[0])) {
            $msg = 'Dish does not exist';
        }
        $isDishConstrained = $this->order_detail->isDishConstrained($id);
        if ($isDishConstrained) {
            if ($isDishConstrained == 'Shipping orders') {
                $msg = "This item cannot be deleted because the order has been shipped";
            } else {
                $deleteDish = $this->dishs->deleteDish($id);
                if ($deleteDish) {
                    $msg = "Delete Dish successfully";
                } else {
                    $msg = "Error occurred while deleting Dish";
                }
            }
        } else {
            $deleteDish = $this->dishs->deleteDish($id);
            // dd($deleteDish);
            if ($deleteDish) {
                $msg = "Delete Dish successfully";
            } else {
                $msg = "Error occurred while deleting Dish";
            }
        }
        return redirect()->route('manage-dish')->with('msg', $msg);
    }
    public function RestoreDish($id)
    {
        $this->dishs->RestoreDish($id);
        return redirect()->route('manage-dish')->with('msg', "Restore Dish successful");
    }
}