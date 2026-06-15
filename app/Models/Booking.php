<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_name', 'client_phone', 'client_whatsapp',
        'business_type', 'selected_products', 'custom_program_idea',
        'meeting_date', 'meeting_time_slot', 'status', 'meeting_link', 'notes'
    ];

    protected $casts = [
        'selected_products' => 'array',
        'meeting_date'      => 'date:Y-m-d',
    ];
}
