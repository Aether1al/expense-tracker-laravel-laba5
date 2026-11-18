<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Еда',
            'Транспорт',
            'Развлечения',
            'Подписки',
            'Здоровье',
            'Подарки',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'monthly_limit' => $this->faker->randomElement([30000, 5000, 10000, 3000, 8000, null]),
            'color' => $this->faker->hexColor(),
        ];
    }
}
