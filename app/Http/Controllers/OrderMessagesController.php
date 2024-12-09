<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\NewOrderMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OrderMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        $messages = $order->messages()->latest()->paginate();

        return view('admin.messages.index', compact('messages', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order, Request $request)
    {
        return DB::transaction(function () use ($request, $order) {
            $request->validate([
                'message' => 'required|string|max:255',
            ]);

            $message = $order->messages()->create([
                'admin_id' => auth()->id(),
                'message' => $request->message,
            ]);

            Notification::send($order->user, new NewOrderMessageNotification($order, $message));

            return redirect()->back()->with('success', 'Message sent successfully.');
        });
    }
}
