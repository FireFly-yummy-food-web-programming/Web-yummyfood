<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use  App\Models\Users;

class UsersController extends Controller
{
    private $users;
    private $orders;
    public function __construct()
    {
        $this->users = new Users();
        $this->orders = new Orders(); 

    }
    public function getUsers(Request $request){
        $title = 'List of users';
        $listUsers = $this->users->getAllUsers();
        return view('admin.dashboard.users', compact('title', 'listUsers'));
    }

    public function getFormAddUsers(Request $request)
    {
        $title = "Add new User";
        return view('admin.users.add', compact('title'));
    }
    
    public function postAddUsers(Request $request)
    {
        $request->validate([
            'Username' => 'required|unique:users|regex:/^[A-Za-z0-9]+$/',
            'Password' => 'required|min:8',
            'Name' => 'required',
            'Phone' => 'required|numeric|digits:10',
            'Email' => 'required|email|unique:users',
        ], [
            'Username.required' => 'Username is required',
            'Username.unique' => 'Username already exists',
            'Username.regex' => 'Username must only contain letters and numbers',
            'Password.required' => 'Password is required',
            'Password.min' => 'Password must be at least 8 characters',
            'Name.required' => 'Name is required',
            'Phone.required' => 'Phone number is required',
            'Phone.numeric' => 'Phone number must be numeric',
            'Phone.digits' => 'Phone number must be 10 digits',
            'Email.required' => 'Email is required',
            'Email.email' => 'Invalid email format',
            'Email.unique' => 'Email already exists',
        ]);
    
        // Hash the password
        $hashedPassword = bcrypt($request->input('Password'));
    
        $dataInsert = [
            'Username' => $request->input('Username'),
            'Password' => $hashedPassword,
            'Name' => $request->input('Name'),
            'Phone' => $request->input('Phone'),
            'Email' => $request->input('Email'),
            'role' => 'customer',
        ];
    
        $this->users->addUser($dataInsert);
        return redirect()->route('manage-users')->with('msg', 'User added successfully');
    }
    
    public function deleteUsers($id)
    {
        $user = $this->users->getUserById($id);
    
        if (!empty($user)) {
            // Kiểm tra xem người dùng có bị ràng buộc khóa ngoại trong bảng orders hay không
            $isUserConstrained = $this->orders->isUserConstrained($id);
    
            if ($isUserConstrained) {
                // Lấy trạng thái của đơn hàng của người dùng
                $orderStatus = $this->orders->getOrderStatusByUserId($id);
    
                if ($orderStatus === 'New order' || $orderStatus === 'Shipping orders') {
                    $msg = "Unable to delete this user. The user has pending orders.";
                } else {
                    // Xóa mềm người dùng nếu trạng thái đơn hàng là 'Delivered orders' hoặc 'Canceled orders'
                    $deleteStatus = $this->users->softDeleteUser($id);
    
                    if ($deleteStatus) {
                        $msg = "User deleted successfully";
                    } else {
                        $msg = "Unable to delete this user";
                    }
                }
            } else {
                // Xóa người dùng không có ràng buộc khóa ngoại
                $deleteStatus = $this->users->deleteUsers($id);
    
                if ($deleteStatus) {
                    $msg = "User deleted successfully";
                } else {
                    $msg = "Unable to delete this user";
                }
            }
        } else {
            $msg = 'User does not exist';
        }
    
        // Lấy lại danh sách người dùng sau khi xóa mềm và trả về view
        $listUsers = $this->users->getAllUsers();
        return redirect()->route('manage-users')->with(['msg' => $msg, 'listUsers' => $listUsers]);
    }    
    public function getFormEditUsers(Request $request, $id)
    {
        $title = "Edit User";
        $user = $this->users->getUserById($id);

        if (!empty($user)) {
            return view('admin.users.edit', compact('title', 'user'));
        } else {
            return redirect()->route('manage-users')->with('msg', 'User does not exist');
        }
    }

    public function postEditUsers(Request $request)
    {
        $user_id = $request->input('user_id');
    
        if (empty($user_id)) {
            return back()->with('msg', 'User does not exist');
        }
    
        $request->validate([
            'Username' => [
                'required',
                Rule::unique('users')->ignore($user_id, 'user_id'), // Thay 'id' bằng 'user_id'
                'regex:/^[A-Za-z0-9]+$/'
            ],
            'Password' => 'required|min:8',
            'Name' => 'required',
            'Phone' => 'required|numeric|digits:10',
            'Email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user_id, 'user_id'), // Thay 'id' bằng 'user_id'
            ],
        ], [
            'Username.required' => 'Username is required',
            'Username.unique' => 'Username already exists',
            'Username.regex' => 'Username must only contain letters and numbers',
            'Password.required' => 'Password is required',
            'Password.min' => 'Password must be at least 8 characters',
            'Name.required' => 'Name is required',
            'Phone.required' => 'Phone number is required',
            'Phone.numeric' => 'Phone number must be numeric',
            'Phone.digits' => 'Phone number must be 10 digits',
            'Email.required' => 'Email is required',
            'Email.email' => 'Invalid email format',
            'Email.unique' => 'Email already exists',
        ]);
    
        $dataUpdate = [
            'Username' => $request->input('Username'),
            'Password' => bcrypt($request->input('Password')),
            'Name' => $request->input('Name'),
            'Phone' => $request->input('Phone'),
            'Email' => $request->input('Email'),
        ];
    
        $this->users->updateUser($user_id, $dataUpdate);
        return back()->with('msg', 'User updated successfully');
    }
}