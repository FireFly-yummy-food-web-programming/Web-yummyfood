<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    
    public function getAllUsers()
    {
        $usersList = DB::table($this->table)->get();
        return $usersList;
    }
    
    public function addUser($data)
    {
        $user = DB::table($this->table)->insert($data);
        return $user;
    }
    
    public function getUserById($id)
    {
        return DB::table($this->table)->where('user_id', $id)->first();
    }
    
    public function deleteUsers($id)
    {
        $deleteQuery = DB::table($this->table)->where('user_id', $id)->delete();
        return $deleteQuery;
    }
    
    public function softDeleteUser($id)
    {
        return $this->where('user_id', $id)->delete();
    }
    
    public function updateUser($id, $data)
    {
        return DB::table($this->table)->where('user_id', $id)->update($data);
    }
}