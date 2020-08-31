<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['user_id', 'product_id', 'quantity'];

}