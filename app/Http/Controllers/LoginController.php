<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
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

                    return redirect()->route('admin.dashboard.dashboard');
                } elseif ($user->role === 'customer') {
                    // Lưu thông tin người dùng vào session
                    $request->session()->put('user_id', $user->user_id);
                    $request->session()->put('logged_in', true);

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

    // Đăng xuất người dùng
    Auth::logout();

    return redirect(route('home'));
}
}