<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'country'];
}
