<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use laravel\sanctum\HasApiTokens;

class Merchant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $guard = 'merchant' ;


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }

    function shop(){
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
