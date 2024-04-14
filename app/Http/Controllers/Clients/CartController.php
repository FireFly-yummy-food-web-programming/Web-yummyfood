<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;


class CartController extends Controller
{

    public function addToCart(Request $request, $id)
{
    $user_id = $request->session()->get('user_id');

    if (!$user_id) {
        // Nếu chưa đăng nhập, có thể chuyển hướng người dùng đến trang đăng nhập
        return redirect()->route('users/login');

        // Hoặc có thể trả về một thông báo lỗi
        // return response()->json(['error' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'], 401);
    }

    $existingCartItem = Cart::where('user_id', $user_id)
        ->where('dish_id', $id)
        ->first();

    if ($existingCartItem) {
        $existingCartItem->quantity += 1;
        $existingCartItem->save();
    } else {
        $cartItem = new Cart();
        $cartItem->user_id = $user_id;
        $cartItem->dish_id = $id;
        $cartItem->quantity = 1;
        $cartItem->save();
    }

    $cartItems = Cart::where('user_id', $user_id)->get();
    return view('clients.cart', compact('cartItems'));
}

    public function viewCart()
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Lấy thông tin giỏ hàng của người dùng từ cơ sở dữ liệu
        $cartItems = Cart::where('user_id', $user->id)->with('dish')->get();

        return view('clients.cart', compact('cartItems'));
    }

    public function updateCart(Request $request, $id)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Lấy thông tin sản phẩm trong giỏ hàng của người dùng
        $cartItem = Cart::where('user_id', $user->id)
            ->where('dish_id', $id)
            ->first();

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (!$cartItem) {
            return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng.'], 404);
        }

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Giỏ hàng đã được cập nhật.'], 200);
    }

    public function removeFromCart($id)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Xóa sản phẩm khỏi giỏ hàng của người dùng
        Cart::where('user_id', $user->id)
            ->where('dish_id', $id)
            ->delete();

        return redirect()->route('view-cart')->with('msg', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
