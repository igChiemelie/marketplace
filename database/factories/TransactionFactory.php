<?php
// database/factories/TransactionFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'amount' => $this->faker->randomFloat(2, 20, 1000),
            'payment_method' => $this->faker->randomElement(['card','bank','wallet']),
            'status' => $this->faker->randomElement(['pending','successful','failed']),
        ];
    }
}
