<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{   
    
    public function showLoginForm()
    {
        return view('clients.login');
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Username' => 'required',
            'Password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $username = $request->input('Username');
        $password = $request->input('Password');

        $user = User::where('Username', $username)->first();
        if ($user) {
            if ($user->validatePassword($password)) {
                if ($user->role === 'admin') {
                    // Lưu thông tin người dùng vào session
                    $request->session()->put('user_id', $user->user_id);
                    $request->session()->put('logged_in', true);
                    $request->session()->put('user_name', $user->Name);
                    $request->session()->put('cart', []);
                    $request->session()->put('numberCart', []);
                    return redirect()->route('manage-contact');
                } elseif ($user->role === 'customer') {
                    // Lưu thông tin người dùng vào session
                    $request->session()->put('user_id', $user->user_id);
                    $request->session()->put('logged_in', true);
                    $request->session()->put('user_name', $user->Name);
                    $user_id =  $request->session()->get('user_id', $user->user_id);
                    $numberCart = DB::table('cart')->where('user_id', session('user_id'))->get()->count();
                    $request->session()->put('numberCart',$numberCart);
                    $listDish =  DB::table('favorites')
                        ->join('dish', 'favorites.dish_id', '=', 'dish.dish_id')
                        ->where('favorites.user_id', $user_id)
                        ->select('dish.*')
                        ->get();   
                    $array = [];
                    foreach ($listDish as $dish){
                        $id = $dish->dish_id;
                        $array[$id] = $id;
                    }
                    $request->session()->put('favoriteId', $array);
                    return redirect(route('home'));
                }
            } else {
                $validator->errors()->add('Password', 'Invalid password.');
            }
        } else {
            $validator->errors()->add('Username', 'Invalid username.');
        }

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    public function logout(Request $request)
{
    // Xóa thông tin người dùng từ session
    $request->session()->forget('user_id');
    $request->session()->forget('logged_in');
    $request->session()->forget('favoriteId');
    $request->session()->forget('favoriteNewId');
    $request->session()->forget('cart');
    $request->session()->forget('user_name');
    // Đăng xuất người dùng
    Auth::logout();

    return redirect(route('home'));
}
}