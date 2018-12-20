<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name', 'price', 'discount_type', 'discount'];

    public $hidden = ['pivot'];

    public function Bundle()
    {
        return $this->belongsToMany(Product::class, 'products_bundle', 'parent_product_id', 'product_id');
    }
}
