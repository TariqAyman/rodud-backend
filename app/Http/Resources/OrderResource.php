<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->userId ?? $this->resource->user_id,
            'pickup_location' => $this->resource->pickupLocation ?? $this->resource->pickup_location,
            'delivery_location' => $this->resource->deliveryLocation ?? $this->resource->delivery_location,
            'size' => $this->resource->size,
            'weight' => $this->resource->weight,
            'pickup_at' => $this->resource->pickupAt ?? $this->resource->pickup_at,
            'delivery_at' => $this->resource->deliveryAt ?? $this->resource->delivery_at,
            'status' => $this->resource->status instanceof OrderStatus
                ? $this->resource->status->value
                : $this->resource->status,
        ];
    }
}
