<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in-progress';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';
}
