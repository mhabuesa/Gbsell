<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'order_id');
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'order_id', 'order_id');
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'order_id', 'order_id');
    }

}
