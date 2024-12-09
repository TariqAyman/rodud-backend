<?php

namespace App\Http\Controllers\API;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()
            ->latest()
            ->user(auth()->id())
            ->paginate();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request)
    {
        $orderData = array_merge([
            'status' => OrderStatus::Pending->value,
            'user_id' => auth()->id(),
        ], $request->validated());

        $order = Order::create($orderData);

        $admins = User::query()->admin()->get();

        Notification::send($admins, new NewOrderNotification($order));

        return OrderResource::make($order);
    }
}
