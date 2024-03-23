<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'Username', 'Password', 'Name', 'Phone', 'Email', 'role',
    ];
}
