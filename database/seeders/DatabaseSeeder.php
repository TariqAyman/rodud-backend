<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderMessage;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a specific admin user
        $admin = User::factory()
            ->asAdmin()
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
            ]);

        // Create some normal users
        $users = User::factory(3)->asUser()->create(); // 3 normal users

        // Create orders for each normal user
        foreach ($users as $user) {
            $orders = Order::factory(3)->create(['user_id' => $user->id]);

            // Create messages for each order
            foreach ($orders as $order) {
                OrderMessage::factory(3)->create(['order_id' => $order->id, 'admin_id' => $admin->id]);
            }
        }

        // Create a specific user
        $user = User::factory()
            ->asUser()
            ->create([
                'name' => 'User',
                'email' => 'user@user.com',
            ]);


        // orders with a specific status:
        Order::factory()
            ->pending()
            ->create(['user_id' => $user->id]);

        Order::factory()
            ->inProgress()
            ->create(['user_id' => $user->id]);

        Order::factory()
            ->delivered()
            ->create(['user_id' => $user->id]);

        Order::factory()
            ->cancelled()
            ->create(['user_id' => $user->id]);
    }
}
