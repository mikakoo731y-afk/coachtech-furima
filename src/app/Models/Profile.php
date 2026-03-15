<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'img_url',
        'postal_code',
        'address',
        'building',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
