<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number',
        'client_name',
        'client_phone',
        'client_whatsapp',
        'system_name',
        'type',
        'priority',
        'status',
        'title',
        'description',
        'admin_reply',
        'admin_reply_at'
    ];

    protected $casts = [
        'admin_reply_at' => 'datetime',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($ticket) {
            // توليد رقم تذكرة فريد تسلسلي يبدأ من RMT-1001
            $latest = static::latest('id')->first();
            $nextNumber = $latest ? ($latest->id + 1001) : 1001;
            $ticket->ticket_number = 'RMT-' . $nextNumber;

            // تعيين الأولوية الافتراضية والحالة الافتراضية إذا لم يتم تمريرهما
            if (empty($ticket->status)) {
                $ticket->status = 'open';
            }
            if (empty($ticket->priority)) {
                $ticket->priority = 'medium';
            }
        });
    }
}
