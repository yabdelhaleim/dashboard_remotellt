<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    // الفترات الزمنية الافتراضية
    const TIME_SLOTS = [
        '10:00 ص', '11:00 ص', '12:00 م',
        '01:00 م', '02:00 م', '03:00 م',
        '04:00 م', '05:00 م', '08:00 م'
    ];

    // GET /api/bookings
    public function index(): JsonResponse
    {
        $bookings = Booking::latest()->get()->map(fn($b) => $this->format($b));
        return response()->json($bookings);
    }

    // POST /api/bookings
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'clientName'         => 'required|string|max:255',
            'clientPhone'        => 'required|string|max:20',
            'clientWhatsapp'     => 'nullable|string|max:20',
            'businessType'       => 'required|string|max:255',
            'selectedProducts'   => 'nullable|array',
            'customProgramIdea'  => 'nullable|string',
            'meetingDate'        => 'required|date|after:today',
            'meetingTimeSlot'    => 'required|string',
            'notes'              => 'nullable|string',
        ]);

        // التحقق من أن الموعد غير محجوز مسبقاً
        $exists = Booking::where('meeting_date', $data['meetingDate'])
            ->where('meeting_time_slot', $data['meetingTimeSlot'])
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'هذا الموعد محجوز بالفعل، يرجى اختيار موعد آخر.'], 422);
        }

        $booking = Booking::create([
            'client_name'         => $data['clientName'],
            'client_phone'        => $data['clientPhone'],
            'client_whatsapp'     => $data['clientWhatsapp'] ?? $data['clientPhone'],
            'business_type'       => $data['businessType'],
            'selected_products'   => $data['selectedProducts'] ?? [],
            'custom_program_idea' => $data['customProgramIdea'] ?? '',
            'meeting_date'        => $data['meetingDate'],
            'meeting_time_slot'   => $data['meetingTimeSlot'],
            'notes'               => $data['notes'] ?? '',
            'status'              => 'new',
        ]);

        return response()->json($this->format($booking), 201);
    }

    // PATCH /api/bookings/{id}/status
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $booking = Booking::findOrFail($id);
        $data = $request->validate(['status' => 'required|in:new,confirmed,completed,cancelled']);
        $booking->update($data);
        return response()->json($this->format($booking));
    }

    // PATCH /api/bookings/{id}/link
    public function updateLink(Request $request, int $id): JsonResponse
    {
        $booking = Booking::findOrFail($id);
        $data = $request->validate(['meeting_link' => 'required|string']);
        $booking->update(['meeting_link' => $data['meeting_link']]);
        return response()->json($this->format($booking));
    }

    // DELETE /api/bookings/{id}
    public function destroy(int $id): JsonResponse
    {
        Booking::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    }

    // GET /api/bookings/available-slots?date=YYYY-MM-DD
    public function availableSlots(Request $request): JsonResponse
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['message' => 'date required'], 422);
        }

        $booked = Booking::where('meeting_date', $date)
            ->whereNotIn('status', ['cancelled'])
            ->pluck('meeting_time_slot')
            ->toArray();

        $available = array_values(array_filter(
            self::TIME_SLOTS,
            fn($slot) => !in_array($slot, $booked)
        ));

        return response()->json($available);
    }

    // GET /api/bookings/available-dates
    public function availableDates(): JsonResponse
    {
        $dates = [];
        $today = now();
        $i = 1;
        while (count($dates) < 7 && $i <= 14) {
            $day = $today->copy()->addDays($i);
            // استثناء يوم الجمعة (5)
            if ($day->dayOfWeek !== 5) {
                $dates[] = $day->toDateString();
            }
            $i++;
        }
        return response()->json($dates);
    }

    // ---------------------------------------------------------------
    private function format(Booking $b): array
    {
        return [
            'id'                => (string) $b->id,
            'clientName'        => $b->client_name,
            'clientPhone'       => $b->client_phone,
            'clientWhatsapp'    => $b->client_whatsapp,
            'businessType'      => $b->business_type,
            'selectedProducts'  => $b->selected_products ?? [],
            'customProgramIdea' => $b->custom_program_idea,
            'meetingDate'       => $b->meeting_date?->toDateString(),
            'meetingTimeSlot'   => $b->meeting_time_slot,
            'status'            => $b->status,
            'meetingLink'       => $b->meeting_link,
            'notes'             => $b->notes,
            'createdAt'         => $b->created_at?->toISOString(),
        ];
    }
}
