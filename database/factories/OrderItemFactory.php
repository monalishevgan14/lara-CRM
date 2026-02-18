<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Order;
use App\Models\Product; 


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        return [
            'order_id' => Order::inRandomOrder()->first()?->id ?? Order::factory(),
            'product_id' => $product?->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $product?->price ?? 100,
        ];
    }
}
