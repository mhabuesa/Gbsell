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

    public function social()
    {
        return $this->hasMany(SocialMedia::class, 'shop_id', 'shop_id');
    }

    function merchant(){
        return $this->belongsTo(Merchant::class, 'shop_id', 'shop_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'shop_id', 'shop_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'shop_id', 'shop_id');
    }


}
