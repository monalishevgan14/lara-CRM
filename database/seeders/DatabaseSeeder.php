<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create Users
        \App\Models\User::factory(5)->create();

        // Create Products
        \App\Models\Product::factory(20)->create();

        // Create Orders
        \App\Models\Order::factory(10)->create()->each(function ($order) {

            // Create 3-5 items per order
            \App\Models\OrderItem::factory(rand(3,5))->create([
                'order_id' => $order->id
            ]);

            // Calculate total amount
            $total = $order->items()->sum(\DB::raw('price * quantity'));

            $order->update([
                'total_amount' => $total
            ]);
        });
    }
}
