<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['dish_id', 'user_id', 'quantity'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->timestamps = false;
        });
    }
}
