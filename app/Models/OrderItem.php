<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'item_name',
        'quantity',
        'price',
        'customizations'
    ];

    protected $casts = [
        'customizations' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuSection::class, 'menu_item_id');
    }
}
