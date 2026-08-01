<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use App\Services\TelegramService;

/**
 * Custom Laravel notification channel that pushes to Telegram via TelegramService.
 *
 * Used by Notification classes via:
 *   public function via($notifiable) { return ['database', TelegramChannel::class]; }
 *
 * The Notification's `toTelegram($notifiable)` method is invoked and the
 * resulting boolean (returned by TelegramService) is ignored — failures are
 * logged inside the service so the queue worker doesn't retry forever.
 */
class TelegramChannel
{
    public function __construct(private TelegramService $telegram) {}

    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toTelegram')) return;
        if (!$this->telegram->isConfigured()) return;

        $payload = $notification->toTelegram($notifiable);
        // The send*() helpers already log + return bool. Nothing else to do.
    }
}