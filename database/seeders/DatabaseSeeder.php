<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Expense;
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

        $users = User::factory()->count(2)->create();

        
        $categories = Category::factory()->count(6)->create();

        for ($i = 0; $i < 30; $i++) {
            $user = $users->random();
            $category = $categories->random();

            Expense::factory()->for($user)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
