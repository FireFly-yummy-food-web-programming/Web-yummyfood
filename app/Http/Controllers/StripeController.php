<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class StripeController extends Controller
{
    public function session(Request $request)
    {
        //$user         = auth()->user();
        $productItems = [];
        $user_email = DB::table('users')->where('user_id',session('user_id'))->first();
        \Stripe\Stripe::setApiKey(config('stripe.sk')); 
        foreach (session('cart') as $id => $details) {
            $product_name = $details['dish_name'];
            $total = $details['price'];
            $quantity = $details['quantity'];
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
            'customer_email' => $user_email->Email, //$user->email,
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
                    'total_price' => $item['price']*$item['quantity'] - $item['price']*$item['quantity']*$item['discount']/100,
                    'discount' => $item['discount'],
                    'quantity' => $item['quantity'],
                    'user_id' => $item['user_id'],
                    'order_date'=> $currentDateTime,
                ]);
            }
        }
        // Xóa session 'cart' sau khi đã chèn dữ liệu thành công vào bảng 'cart'
        session()->forget('cart');        
        return "<div style='display: flex; justify-content: center;'><img src='https://www.mgt-commerce.com/astatic/assets/images/article/2023/225/hero.svg?v=1.0.2' width='100%';> </div>";
    }
    public function cancel()
    {
        return view('clients.cancel');
    }
}
