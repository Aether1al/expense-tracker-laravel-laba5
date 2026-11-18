<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'amount' => $this->faker->numberBetween(50,5000),
            'description' => $this->faker->realText(200),
            'spent_at'=> $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
