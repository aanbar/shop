<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public $table = 'orders_items';

    public $fillable = ['order_id', 'quantity', 'product_id', 'product_name',
        'product_price', 'product_discount_type', 'product_discount', 'bundle_data'];
}
