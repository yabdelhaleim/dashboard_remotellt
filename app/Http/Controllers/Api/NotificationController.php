<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Notifications\DatabaseNotification;

/**
 * Admin Notification API — list, mark read, mark all read.
 *
 * All notifications have notifiable_type = 'admin', so we filter on that.
 */
class NotificationController extends Controller
{
    /**
     * GET /api/admin/notifications
     * Query: ?limit=20&unread_only=1
     */
    public function index(Request $request): JsonResponse
    {
        $limit = (int) $request->input('limit', 25);
        $limit = max(1, min(100, $limit));

        $query = DatabaseNotification::query()
            ->where('notifiable_type', 'admin')
            ->orderByDesc('created_at');

        if ($request->boolean('unread_only')) {
            $query->whereNull('read_at');
        }

        $items = $query->limit($limit)->get()->map(fn ($n) => $this->format($n));

        $unreadCount = DatabaseNotification::query()
            ->where('notifiable_type', 'admin')
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'notifications' => $items,
            'unread_count'  => $unreadCount,
        ]);
    }

    /**
     * POST /api/admin/notifications/{id}/read
     */
    public function markRead(string $id): JsonResponse
    {
        $n = DatabaseNotification::query()
            ->where('id', $id)
            ->where('notifiable_type', 'admin')
            ->firstOrFail();

        if (is_null($n->read_at)) {
            $n->markAsRead();
        }

        return response()->json(['ok' => true]);
    }

    /**
     * POST /api/admin/notifications/read-all
     */
    public function markAllRead(): JsonResponse
    {
        DatabaseNotification::query()
            ->where('notifiable_type', 'admin')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['ok' => true]);
    }

    /**
     * DELETE /api/admin/notifications/{id}
     */
    public function destroy(string $id): JsonResponse
    {
        $n = DatabaseNotification::query()
            ->where('id', $id)
            ->where('notifiable_type', 'admin')
            ->firstOrFail();

        $n->delete();
        return response()->json(['ok' => true]);
    }

    /**
     * Format a notification into a JSON-friendly shape.
     */
    private function format(DatabaseNotification $n): array
    {
        $data = is_array($n->data) ? $n->data : [];

        return [
            'id'         => $n->id,
            'type'       => $data['type']    ?? 'generic',
            'title'      => $data['title']   ?? 'إشعار',
            'message'    => $data['message'] ?? '',
            'icon'       => $data['icon']    ?? 'bell',
            'link'       => $data['link']    ?? null,
            'is_read'    => !is_null($n->read_at),
            'created_at' => $n->created_at?->toIso8601String(),
            'meta'       => $data, // raw payload (client_name, phone, etc.)
        ];
    }
}