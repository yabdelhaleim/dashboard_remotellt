<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'phone', 'whatsapp', 'address',
        'business', 'product', 'package', 'notes', 'status'
    ];
}
