<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth'); // Thêm middleware này vào constructor của CartController để yêu cầu xác thực người dùng
    }

    public function addToCart($id)
    {
        // Xử lý logic thêm sản phẩm vào giỏ hàng ở đây
        // Ví dụ:
        $cartItem = new Cart();
        $cartItem->dish_id = $id; // Giả sử dish_id là cột trong bảng Cart để lưu ID sản phẩm
        $cartItem->user_id = auth()->user()->id; // Lưu user_id nếu bạn đã đăng nhập
        $cartItem->dish_name;
        $cartItem->image;
        $cartItem->quantity;
        $cartItem->price;
        $cartItem->discount;
        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}