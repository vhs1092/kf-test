<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'coop_id' => \App\Models\Coop::factory(),
            'buyer_id' => \App\Models\Buyer::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 75000),
            'package_quantity' => $this->faker->numberBetween($min = 1, $max = 20),
            'package_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'banking_customer_token' => $this->faker->randomDigit(),
            'coop_canceled' => $this->faker->boolean()
        ];
    }
}
