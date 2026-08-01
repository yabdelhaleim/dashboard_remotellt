<?php

/**
 * debug_telegram.php — run this on the production server to diagnose
 * why the Telegram push isn't firing.
 *
 * Usage:
 *   php debug_telegram.php
 */

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "═══════════════════════════════════════════════\n";
echo "  Telegram Notification Diagnostic\n";
echo "═══════════════════════════════════════════════\n\n";

// 1. Check env
echo "1. ENV values:\n";
echo "   TELEGRAM_BOT_TOKEN: " . (env('TELEGRAM_BOT_TOKEN') ? '✓ set ('.substr(env('TELEGRAM_BOT_TOKEN'), 0, 20).'...)' : '✗ EMPTY') . "\n";
echo "   TELEGRAM_CHAT_ID:   " . (env('TELEGRAM_CHAT_ID')   ? '✓ set ('.env('TELEGRAM_CHAT_ID').')' : '✗ EMPTY') . "\n\n";

// 2. Check service
$svc = app(\App\Services\TelegramService::class);
echo "2. TelegramService::isConfigured() → " . ($svc->isConfigured() ? 'YES ✓' : 'NO ✗') . "\n\n";

// 3. Check classes exist
echo "3. Required classes:\n";
echo "   AdminNotifiable:        " . (class_exists(\App\Models\AdminNotifiable::class)        ? '✓' : '✗ MISSING') . "\n";
echo "   NewBookingNotification: " . (class_exists(\App\Notifications\NewBookingNotification::class) ? '✓' : '✗ MISSING') . "\n";
echo "   NewTicketNotification:  " . (class_exists(\App\Notifications\NewTicketNotification::class)  ? '✓' : '✗ MISSING') . "\n";
echo "   NewLeadNotification:    " . (class_exists(\App\Notifications\NewLeadNotification::class)    ? '✓' : '✗ MISSING') . "\n";
echo "   TelegramChannel:        " . (class_exists(\App\Notifications\Channels\TelegramChannel::class) ? '✓' : '✗ MISSING') . "\n\n";

// 4. Check tables
echo "4. Required tables:\n";
echo "   notifications: " . (\Illuminate\Support\Facades\Schema::hasTable('notifications') ? '✓ EXISTS' : '✗ MISSING') . "\n\n";

// 5. Try to send
echo "5. Attempting direct Telegram send...\n";
$result = $svc->send("🧪 DEBUG TEST from production at " . now()->toDateTimeString());
echo "   Send result: " . ($result ? '✓ SUCCESS — check your Telegram!' : '✗ FAILED (see logs)') . "\n\n";

// 6. Check most recent log entries
echo "6. Last 5 log entries:\n";
$logPath = __DIR__ . '/storage/logs/laravel.log';
if (file_exists($logPath)) {
    $lines = file($logPath);
    $recent = array_slice($lines, -5);
    foreach ($recent as $line) {
        echo "   " . trim($line) . "\n";
    }
} else {
    echo "   (no log file)\n";
}

echo "\n═══════════════════════════════════════════════\n";
echo "  Done.\n";
echo "═══════════════════════════════════════════════\n";