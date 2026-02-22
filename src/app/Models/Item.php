<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'brand_name',
        'price',
        'description',
        'img_url'
    ];
}
