<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_date'=>fake()->dateTimeBetween('1-12-1995', 'now'),
            'category_id'=> Category::inRandomOrder()->first(),
            'description'=> fake()->paragraph(20),
            'amount'=>fake()->numberBetween(100,6000),
        ];
    }
}
