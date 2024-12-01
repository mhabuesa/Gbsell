<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function payment()
    {
        return $this->hasMany(PaymentGateway::class);
    }


}
