<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource (Admin only).
     */
    public function index(Request $request)
    {
        $query = Ticket::query();

        // تصفية حسب الحالة
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // تصفية حسب الأولوية
        if ($request->has('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        // تصفية حسب نوع الطلب
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // البحث بالرقم أو الاسم أو الهاتف
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_phone', 'like', "%{$search}%");
            });
        }

        // الترتيب الأحدث أولاً
        $tickets = $query->orderBy('created_at', 'desc')->get();

        return response()->json($tickets);
    }

    /**
     * Store a newly created resource in storage (Public).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name'     => 'required|string|max:255',
            'client_phone'    => 'required|string|max:20',
            'client_whatsapp' => 'nullable|string|max:20',
            'system_name'     => 'required|string|max:255',
            'type'            => 'required|string|in:support,modification',
            'priority'        => 'required|string|in:low,medium,high,urgent',
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
        ], [
            'client_name.required' => 'يرجى إدخال اسم العميل بالكامل.',
            'client_phone.required' => 'يرجى إدخال رقم الهاتف.',
            'system_name.required' => 'يرجى اختيار النظام أو البرنامج.',
            'type.required'        => 'يرجى اختيار نوع التذكرة.',
            'priority.required'    => 'يرجى تحديد درجة الأهمية.',
            'title.required'       => 'يرجى كتابة عنوان التذكرة.',
            'description.required' => 'يرجى كتابة تفاصيل المشكلة أو الطلب.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors()
            ], 422);
        }

        $ticket = Ticket::create($validator->validated());

        return response()->json($ticket, 201);
    }

    /**
     * Track a specific ticket using ticket_number and client_phone (Public).
     */
    public function track(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_number' => 'required|string',
            'client_phone'  => 'required|string',
        ], [
            'ticket_number.required' => 'يرجى إدخال رقم التذكرة.',
            'client_phone.required'  => 'يرجى إدخال رقم الهاتف المسجل بالتذكرة.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $ticket = Ticket::where('ticket_number', trim($request->ticket_number))
            ->where('client_phone', trim($request->client_phone))
            ->first();

        if (!$ticket) {
            return response()->json([
                'message' => 'عذراً، لم نجد تذكرة مطابقة لهذه البيانات. يرجى التحقق من رقم التذكرة ورقم الهاتف.'
            ], 404);
        }

        return response()->json($ticket);
    }

    /**
     * Update status (Admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:open,in_progress,resolved,closed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'حالة غير صالحة.'], 422);
        }

        $ticket->update(['status' => $request->status]);

        return response()->json($ticket);
    }

    /**
     * Update priority (Admin).
     */
    public function updatePriority(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'priority' => 'required|string|in:low,medium,high,urgent',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'أهمية غير صالحة.'], 422);
        }

        $ticket->update(['priority' => $request->priority]);

        return response()->json($ticket);
    }

    /**
     * Add admin reply (Admin).
     */
    public function addReply(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'admin_reply' => 'required|string',
            'status'      => 'nullable|string|in:open,in_progress,resolved,closed',
        ], [
            'admin_reply.required' => 'يرجى كتابة نص الرد.',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $updateData = [
            'admin_reply'    => $request->admin_reply,
            'admin_reply_at' => now(),
        ];

        // إذا تم تمرير حالة جديدة، يتم تحديثها، وإلا يتم تحديثها تلقائياً إلى "resolved"
        if ($request->has('status') && !empty($request->status)) {
            $updateData['status'] = $request->status;
        } else {
            // تحويل الحالة تلقائياً إلى resolved عند الرد
            $updateData['status'] = 'resolved';
        }

        $ticket->update($updateData);

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage (Admin).
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['success' => true]);
    }
}
