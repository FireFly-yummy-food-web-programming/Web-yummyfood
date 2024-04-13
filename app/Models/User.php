<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id', 'user_id');
    }

    protected $fillable = [
        'Username', 'Password', 'Name', 'Phone', 'Email', 'role',
    ];
    protected $table = 'users';

    public function validatePassword($password)
    {
        return password_verify($password, $this->Password);
    }
}
