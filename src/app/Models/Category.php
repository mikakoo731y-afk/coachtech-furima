<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['content'];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_category');
    }
}