<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'buyer_id' => \App\Models\Buyer::factory(),
            'coop_id' => \App\Models\Coop::factory(),
            'purchase_id' => \App\Models\Purchase::factory(),
            'type' => $this->faker->randomElement([
                'bonus',
                'purchase',
                'commission',
                'credit',
                'gift',
                'payback',
                'payout',
                'refund',
                'withdraw',
                'withdrawfee',
            ]),
            'amount' => $this->faker->randomFloat(2, 0, 75000),
            'source' => $this->faker->randomElement(\App\Models\Transaction::sources()),
            'memo' => $this->faker->sentence,
            'is_canceled' => false,
            'is_pending' => false,
        ];
    }
}
