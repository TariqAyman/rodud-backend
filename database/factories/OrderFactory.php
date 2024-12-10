<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Choose a random status
        $statuses = [
            OrderStatus::Pending->value,
            OrderStatus::InProgress->value,
            OrderStatus::Delivered->value,
            OrderStatus::Cancelled->value,
        ];

        return [
            'user_id' => User::factory()->asUser()->create(), // creates a related user by default
            'pickup_location' => $this->faker->streetAddress(),
            'delivery_location' => $this->faker->streetAddress(),
            'item' => $this->faker->word(),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'weight' => $this->faker->randomElement(['10kg', '50kg', '100kg']),
            'pickup_at' => $this->faker->dateTimeBetween('now', '+1 week'),
            'delivery_at' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => $this->faker->randomElement($statuses),
        ];
    }

    public function pending()
    {
        return $this->state(fn() => ['status' => OrderStatus::Pending->value]);
    }

    public function inProgress()
    {
        return $this->state(fn() => ['status' => OrderStatus::InProgress->value]);
    }

    public function delivered()
    {
        return $this->state(fn() => ['status' => OrderStatus::Delivered->value]);
    }

    public function cancelled()
    {
        return $this->state(fn() => ['status' => OrderStatus::Cancelled->value]);
    }
}
