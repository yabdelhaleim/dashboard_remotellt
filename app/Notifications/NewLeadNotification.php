<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Services\TelegramService;
use App\Notifications\Channels\TelegramChannel;

/**
 * NewLeadNotification — fires when a public "request activation" comes in.
 */
class NewLeadNotification extends Notification
{
    use Queueable;

    public function __construct(public array $lead) {}

    public function via($notifiable): array
    {
        $channels = ['database'];

        if (app(TelegramService::class)->isConfigured()) {
            $channels[] = TelegramChannel::class;
        }

        return $channels;
    }

    public function toArray($notifiable): array
    {
        return [
            'type'        => 'lead',
            'title'       => 'طلب تفعيل جديد',
            'message'     => "طلب جديد من {$this->lead['name']} — {$this->lead['product']}",
            'icon'        => 'inbox',
            'lead_id'     => $this->lead['id'] ?? null,
            'client_name' => $this->lead['name'] ?? null,
            'client_phone'=> $this->lead['phone'] ?? null,
            'product'     => $this->lead['product'] ?? null,
            'link'        => '/admin/requests',
        ];
    }

    public function toTelegram($notifiable): array
    {
        return [
            'message' => app(TelegramService::class)->sendNewLead($this->lead),
        ];
    }
}