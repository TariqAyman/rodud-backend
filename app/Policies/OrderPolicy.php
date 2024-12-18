<?php

namespace App\Policies;

use App\Enums\UserType;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->type == UserType::Admin->value || $user->id == $order->user_id;
    }
}
