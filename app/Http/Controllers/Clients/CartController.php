<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\User;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Dish::find($id);
        if (!$product) {
            abort(404);
        }

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện chức năng này.'], 403);
        }

        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Thêm sản phẩm vào giỏ hàng
        $cart = session()->get('cart');
        // Nếu giỏ hàng trống, thêm sản phẩm mới
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                ]
            ];
            session()->put('cart', $cart);
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng.'], 200);
        }
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Số lượng sản phẩm đã được cập nhật trong giỏ hàng.'], 200);
        }
        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
        ];
        session()->put('cart', $cart);
        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng.'], 200);
    }
}
