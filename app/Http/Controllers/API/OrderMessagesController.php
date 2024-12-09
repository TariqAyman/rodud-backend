<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\OrderMessageResource;
use App\Models\User;
use App\Notifications\NewOrderMessageAdminNotification;
use App\Notifications\NewOrderMessageNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderMessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        Gate::authorize('view', $order);

        $messages = $order->messages()->latest()->with(['admin'])->paginate();

        return OrderMessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        Gate::authorize('view', $order);

        return DB::transaction(function () use ($request, $order) {
            $request->validate([
                'message' => 'required|string|max:255',
            ]);

            $message = $order->messages()->create([
                'admin_id' => auth()->id(),
                'message' => $request->message,
            ]);

            $admins = User::query()->admin()->get();

            Notification::send($admins, new NewOrderMessageAdminNotification($order));

            return OrderMessageResource::make($message);
        });
    }
}
