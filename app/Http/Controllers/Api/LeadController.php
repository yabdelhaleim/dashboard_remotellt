<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    // GET /api/leads
    public function index(): JsonResponse
    {
        $leads = Lead::latest()->get()->map(fn($l) => $this->format($l));
        return response()->json($leads);
    }

    // POST /api/leads
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'business' => 'nullable|string|max:255',
            'product'  => 'nullable|string|max:255',
            'package'  => 'nullable|string|max:255',
            'notes'    => 'nullable|string',
        ]);

        $lead = Lead::create(array_merge($data, ['status' => 'new']));
        return response()->json($this->format($lead), 201);
    }

    // PATCH /api/leads/{id}/status
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $lead = Lead::findOrFail($id);
        $data = $request->validate(['status' => 'required|in:new,contacted,converted,cancelled']);
        $lead->update($data);
        return response()->json($this->format($lead));
    }

    // DELETE /api/leads/{id}
    public function destroy(int $id): JsonResponse
    {
        Lead::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    }

    // GET /api/stats — إحصائيات لوحة التحكم
    public function stats(): JsonResponse
    {
        return response()->json([
            'leads'    => ['total' => Lead::count(),    'new' => Lead::where('status', 'new')->count()],
            'bookings' => ['total' => \App\Models\Booking::count(), 'new' => \App\Models\Booking::where('status', 'new')->count()],
            'products' => ['total' => \App\Models\Product::where('is_active', true)->count()],
        ]);
    }

    // ---------------------------------------------------------------
    private function format(Lead $l): array
    {
        return [
            'id'        => (string) $l->id,
            'name'      => $l->name,
            'phone'     => $l->phone,
            'whatsapp'  => $l->whatsapp,
            'address'   => $l->address,
            'business'  => $l->business,
            'product'   => $l->product,
            'package'   => $l->package,
            'notes'     => $l->notes,
            'status'    => $l->status,
            'createdAt' => $l->created_at?->toISOString(),
        ];
    }
}
