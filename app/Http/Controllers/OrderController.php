<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\UpdateOrderStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        return DB::transaction(function () use ($request, $order) {
            $request->validate([
                'status' => 'required|in:' . implode(',', (array) (Order::$nextStatus[$order->status] ?? []))
            ]);

            $order->update(['status' => $request->status]);

            Notification::send($order->user, new UpdateOrderStatusNotification($order));

            return redirect()->back()->with('success', 'Order status updated successfully.');
        });
    }
}
