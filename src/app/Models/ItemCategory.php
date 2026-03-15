<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = 'item_category';

    protected $fillable = ['item_id', 'category_id'];

    public $timestamps = false;
}
