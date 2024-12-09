<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item',
        'size',
        'weight',
        'pickup_location',
        'pickup_at',
        'delivery_location',
        'delivery_at',
        'status'
    ];

    public static array $nextStatus = [
        OrderStatus::Pending->value => [OrderStatus::Cancelled->value, OrderStatus::InProgress->value],
        OrderStatus::InProgress->value => OrderStatus::Delivered->value,
        OrderStatus::Delivered->value => null,
        OrderStatus::Cancelled->value => null,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(OrderMessage::class);
    }

    public function scopeUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }
}
