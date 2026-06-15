<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    protected $fillable = [
        'product_id', 'name', 'price', 'features', 'highlighted', 'sort_order'
    ];

    protected $casts = [
        'features'    => 'array',
        'highlighted' => 'boolean',
        'price'       => 'float',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
