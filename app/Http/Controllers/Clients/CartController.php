<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('clients.cart');
    }

    public function addToCart(Request $request, $id)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thực hiện chức năng này.'], 403);
        }

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('dish_id', $id)
            ->first();

        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
            return response()->json(['message' => 'Số lượng sản phẩm đã được cập nhật trong giỏ hàng.'], 200);
        }

        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
        $cartItem = new Cart();
        $cartItem->user_id = $user->id;
        $cartItem->dish_id = $id;
        $cartItem->quantity = 1;
        $cartItem->save();

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng.'], 200);
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
