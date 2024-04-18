<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function postRegister(Request $request)
    {
        // Validation
        $request->validate([
            'username' => [
                'required',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (strpos($value, ' ') !== false) {
                        $fail('The ' . $attribute . ' cannot contain spaces.');
                    }
                },
            ],
            'password' => 'required|min:6',
            'name' => 'required',
            'phone' => 'nullable|regex:/^[0-9\s]+$/|unique:users',
            'email' => 'required|email|unique:users',
        ]);

        // Create and save the user
        $user = new User();
        $user->Username = $request->username;
        $user->Password = Hash::make($request->password);
        $user->Name = $request->name;
        $user->Phone = $request->phone;
        $user->Email = $request->email;
        $user->save();

        // Redirect to login page or any other page
        return redirect(route('users.login'))->with('success', 'Registration successful. Please login.')->withInput();
    }

    public function getRegister()
    {
        return view('clients.register');
    }
}
