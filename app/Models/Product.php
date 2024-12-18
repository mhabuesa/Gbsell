<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function meta(){
        return $this->hasOne(ProductMetaInfo::class, 'product_id');
    }

    public function gallery(){
        return $this->hasMany(Gallery::class, 'product_id');
    }
    public function variant(){
        return $this->hasMany(Variant::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'shop_id');
    }
}
