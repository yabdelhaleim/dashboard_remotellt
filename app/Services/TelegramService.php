<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * TelegramService — free push notifications via Telegram Bot API.
 *
 * Setup:
 *   1. Talk to @BotFather on Telegram → /newbot → copy Bot Token
 *   2. Send any message to your new bot from your personal Telegram
 *   3. Get your chat_id via: https://api.telegram.org/bot<TOKEN>/getUpdates
 *   4. Add to .env:
 *        TELEGRAM_BOT_TOKEN=123456:ABC...
 *        TELEGRAM_CHAT_ID=987654321
 *
 * Usage:
 *   $tg = app(TelegramService::class);
 *   $tg->send("🎉 عميل جديد: أحمد من القاهرة");
 *
 * 100% free, unlimited messages, instant push to mobile + desktop.
 */
class TelegramService
{
    private string $apiBase = 'https://api.telegram.org/bot';

    /**
     * Whether the bot is configured (token + chat_id present).
     */
    public function isConfigured(): bool
    {
        return !empty($this->token()) && !empty($this->chatId());
    }

    /**
     * Send a plain text message to the configured chat.
     *
     * @return bool true on success, false if Telegram rejected or unconfigured.
     */
    public function send(string $message, array $extra = []): bool
    {
        if (!$this->isConfigured()) {
            Log::debug('TelegramService: skipped send (not configured)');
            return false;
        }

        $payload = array_merge([
            'chat_id'    => $this->chatId(),
            'text'       => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ], $extra);

        try {
            $response = Http::timeout(8)
                ->post($this->apiBase . $this->token() . '/sendMessage', $payload);

            if ($response->successful()) {
                return true;
            }

            Log::warning('TelegramService: send failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return false;
        } catch (\Throwable $e) {
            Log::error('TelegramService: exception', ['msg' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send a formatted "new booking" notification.
     */
    public function sendNewBooking(array $booking): bool
    {
        $name    = $booking['clientName']    ?? 'بدون اسم';
        $phone   = $booking['clientPhone']   ?? '';
        $biz     = $booking['businessType']  ?? '—';
        $date    = $booking['meetingDate']   ?? '—';
        $slot    = $booking['meetingTimeSlot'] ?? '—';
        $prods   = is_array($booking['selectedProducts'] ?? null)
                   ? implode(' • ', $booking['selectedProducts'])
                   : '—';

        $msg = "🆕 <b>حجز استشارة جديد</b>\n"
             . "━━━━━━━━━━━━━━━\n"
             . "👤 <b>الاسم:</b> {$name}\n"
             . "📞 <b>الموبايل:</b> <code>{$phone}</code>\n"
             . "🏢 <b>النشاط:</b> {$biz}\n"
             . "🛒 <b>الأنظمة:</b> {$prods}\n"
             . "📅 <b>الموعد:</b> {$date} — {$slot}\n"
             . "━━━━━━━━━━━━━━━\n"
             . "🌐 remotelly1.site/admin/bookings";

        return $this->send($msg);
    }

    /**
     * Send a formatted "new ticket" notification.
     */
    public function sendNewTicket(array $ticket): bool
    {
        $number  = $ticket['ticket_number'] ?? '—';
        $name    = $ticket['client_name']   ?? '—';
        $phone   = $ticket['client_phone']  ?? '';
        $type    = $ticket['type']          ?? 'general';
        $priority= $ticket['priority']      ?? 'normal';
        $subject = $ticket['subject'] ?? $ticket['title'] ?? 'بدون عنوان';

        $priorityEmoji = match ($priority) {
            'urgent'   => '🔴',
            'high'     => '🟠',
            'normal'   => '🟢',
            default    => '⚪',
        };

        $msg = "🎫 <b>تذكرة دعم فني جديدة</b>\n"
             . "━━━━━━━━━━━━━━━\n"
             . "🎟 <b>رقم التذكرة:</b> <code>{$number}</code>\n"
             . "👤 <b>العميل:</b> {$name}\n"
             . "📞 <b>الموبايل:</b> <code>{$phone}</code>\n"
             . "{$priorityEmoji} <b>الأولوية:</b> {$priority}\n"
             . "📋 <b>النوع:</b> {$type}\n"
             . "📝 <b>الموضوع:</b> {$subject}\n"
             . "━━━━━━━━━━━━━━━\n"
             . "🌐 remotelly1.site/admin/tickets";

        return $this->send($msg);
    }

    /**
     * Send a formatted "new lead / request" notification.
     */
    public function sendNewLead(array $lead): bool
    {
        $name    = $lead['name']     ?? '—';
        $phone   = $lead['phone']    ?? '';
        $biz     = $lead['business'] ?? '—';
        $product = $lead['product']  ?? '—';
        $pkg     = $lead['package']  ?? '';

        $msg = "📥 <b>طلب تفعيل جديد</b>\n"
             . "━━━━━━━━━━━━━━━\n"
             . "👤 <b>الاسم:</b> {$name}\n"
             . "📞 <b>الموبايل:</b> <code>{$phone}</code>\n"
             . "🏢 <b>النشاط:</b> {$biz}\n"
             . "🛒 <b>المنتج:</b> {$product}\n"
             . ($pkg ? "📦 <b>الباقة:</b> {$pkg}\n" : '')
             . "━━━━━━━━━━━━━━━\n"
             . "🌐 remotelly1.site/admin/requests";

        return $this->send($msg);
    }

    // ───────────────────────────────────────────
    // Private helpers
    // ───────────────────────────────────────────
    private function token(): ?string
    {
        $token = config('services.telegram.bot_token')
              ?? env('TELEGRAM_BOT_TOKEN');
        return $token ?: null;
    }

    private function chatId(): ?string
    {
        $chatId = config('services.telegram.chat_id')
               ?? env('TELEGRAM_CHAT_ID');
        return $chatId ?: null;
    }
}