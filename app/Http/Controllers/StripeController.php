<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StripeController extends Controller
{
    //
    public function session(Request $request)
    {
        //$user         = auth()->user();
        $productItems = [];
 
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        foreach (session('cart') as $id => $details) {
 
            $product_name = $details['dish_name'];
            $total = $details['price'];
            $quantity = $details['quantity'];
 
            // $two0 = "00";
            // $unit_amount = "$total$two0";
            $unit_amount = $total *100;
 
            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'USD',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
        }
 
        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            // 'customer_email' => "cairocoders-ednalan@gmail.com", //$user->email,
            'customer_email' => "thao.le25@student.passerellesnumeriques.org", //$user->email,
            'success_url' => route('users.success'),
            'cancel_url'  => route('users.cancel'),
        ]);
     
        return redirect()->away($checkoutSession->url);
    }
 
    public function success()
    {   
        $cartItems = session('cart');
        $currentDateTime = Carbon::now();

    // Kiểm tra nếu có dữ liệu trong session 'cart'
        if ($cartItems) {
            foreach ($cartItems as$dishId => $item) {
                // Chèn dữ liệu vào bảng 'cart' sử dụng Query Builder
                DB::table('orders')->insert([
                    'dish_id' => $dishId,
                    // 'dish_name' => $item['dish_name'],
                    // 'image_dish' => $item['image_dish'],
                    'totalprice' => $item['price'],
                    'discount' => $item['discount'],
                    'quantity' => $item['quantity'],
                    'user_id' => $item['user_id'],
                    // 'status' => 'new orders',
                    'order_date'=> $currentDateTime,
                ]);
            }
                // Hoặc sử dụng Model Cart
                // Cart::create([
                //     'dish_name' => $item['dish_name'],
                //     'image_dish' => $item['image_dish'],
                //     'price' => $item['price'],
                //     'discount' => $item['discount'],
                //     'quantity' => $item['quantity'],
                //     'user_id' => $item['user_id']
                // ]);
            }

        // Xóa session 'cart' sau khi đã chèn dữ liệu thành công vào bảng 'cart'
        session()->forget('cart');
        return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }
 
    public function cancel()
    {
        return view('clients.cancel');
    }
}
