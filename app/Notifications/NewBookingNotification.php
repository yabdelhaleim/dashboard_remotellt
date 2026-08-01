<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Services\TelegramService;
use App\Notifications\Channels\TelegramChannel;

/**
 * NewBookingNotification — fires when a consultation booking arrives.
 *
 * Channels:
 *   - database: stored in `notifications` table (dismissable in dashboard)
 *   - telegram: forwarded to TelegramService for instant push
 */
class NewBookingNotification extends Notification
{
    use Queueable;

    public function __construct(public array $booking) {}

    /**
     * Channel list — both database AND telegram.
     */
    public function via($notifiable): array
    {
        $channels = ['database'];

        // Only add telegram if configured (avoid spam in logs when not set up)
        if (app(TelegramService::class)->isConfigured()) {
            $channels[] = TelegramChannel::class;
        }

        return $channels;
    }

    /**
     * Database representation (stored in `data` JSON column).
     */
    public function toArray($notifiable): array
    {
        return [
            'type'         => 'booking',
            'title'        => 'حجز استشارة جديد',
            'message'      => "حجز جديد من {$this->booking['clientName']} — {$this->booking['meetingDate']} {$this->booking['meetingTimeSlot']}",
            'icon'         => 'calendar',
            'booking_id'   => $this->booking['id'] ?? null,
            'client_name'  => $this->booking['clientName'] ?? null,
            'client_phone' => $this->booking['clientPhone'] ?? null,
            'meeting_date' => $this->booking['meetingDate'] ?? null,
            'meeting_slot' => $this->booking['meetingTimeSlot'] ?? null,
            'link'         => '/admin/bookings',
        ];
    }

    /**
     * Telegram representation (sent to TelegramService).
     */
    public function toTelegram($notifiable): array
    {
        return [
            'message' => app(TelegramService::class)->sendNewBooking($this->booking),
        ];
    }
}