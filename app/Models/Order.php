<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'tax',
        'delivery_fee',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'payment_id',
        'delivery_address',
        'phone',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
