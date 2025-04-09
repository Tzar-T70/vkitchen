<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        // Create a test user if none exists
        $user = User::firstOrCreate([
            'username' => 'testchef',
            'email' => 'chef@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Sample recipes data
        $recipes = [
            [
                'name' => 'Classic Spaghetti Carbonara',
                'description' => 'Creamy Italian pasta dish with eggs, cheese, and pancetta',
                'type' => 'Italian',
                'cookingtime' => 20,
                'ingredients' => "Spaghetti\nEggs\nPancetta\nParmesan cheese\nBlack pepper",
                'instructions' => "1. Cook pasta\n2. Fry pancetta\n3. Mix eggs and cheese\n4. Combine everything",
                'uid' => $user->uid,
            ],
            [
                'name' => 'Vegetable Stir Fry',
                'description' => 'Healthy Asian-style vegetable dish',
                'type' => 'Chinese',
                'cookingtime' => 15,
                'ingredients' => "Broccoli\nBell peppers\nCarrots\nSoy sauce\nGarlic",
                'instructions' => "1. Chop vegetables\n2. Heat oil\n3. Stir fry vegetables\n4. Add sauce",
                'uid' => $user->uid,
            ],
            [
                'name' => 'Beef Bourguignon',
                'description' => 'Classic French stew',
                'type' => 'French',
                'cookingtime' => 180,
                'ingredients' => "Beef chuck\nRed wine\nCarrots\nOnions\nMushrooms",
                'instructions' => "1. Brown the beef\n2. Sauté vegetables\n3. Simmer with wine\n4. Cook for 3 hours",
                'uid' => $user->uid,
            ]
        ];

        // Insert recipes
        foreach ($recipes as $recipeData) {
            Recipe::create($recipeData);
        }
    }
}