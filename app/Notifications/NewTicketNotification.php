<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Services\TelegramService;
use App\Notifications\Channels\TelegramChannel;

/**
 * NewTicketNotification — fires when a support ticket is created.
 */
class NewTicketNotification extends Notification
{
    use Queueable;

    public function __construct(public array $ticket) {}

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
        $subject = $this->ticket['subject']
                 ?? $this->ticket['title']
                 ?? 'بدون عنوان';
        $number  = $this->ticket['ticket_number'] ?? '—';

        return [
            'type'           => 'ticket',
            'title'          => 'تذكرة دعم فني جديدة',
            'message'        => "[{$number}] {$subject}",
            'icon'           => 'ticket',
            'ticket_id'      => $this->ticket['id'] ?? null,
            'ticket_number'  => $number,
            'subject'        => $subject,
            'priority'       => $this->ticket['priority'] ?? 'normal',
            'client_name'    => $this->ticket['client_name'] ?? null,
            'link'           => '/admin/tickets',
        ];
    }

    public function toTelegram($notifiable): array
    {
        return [
            'message' => app(TelegramService::class)->sendNewTicket($this->ticket),
        ];
    }
}