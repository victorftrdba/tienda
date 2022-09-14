<?php

namespace Database\Factories;

use App\Http\Services\PlaceToPayService;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'customer_mobile' => $this->faker->phoneNumber(),
            'product_id' => Product::factory()->create()->id,
        ];

        return [
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'customer_mobile' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement([Order::CREATED, Order::PAYED, Order::REJECTED]),
            'request_id' => (new PlaceToPayService())->createSession($data, User::factory()->create()),
            'product_id' => Product::factory()->create()->id,
            'user_id' => User::factory()->create()->id
        ];
    }
}
