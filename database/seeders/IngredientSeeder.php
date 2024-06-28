<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            [
                'name' => 'Tomato',
                'type' => 'food',
            ],
            [
                'name' => 'Milk',
                'type' => 'drink',
            ],
            [
                'name' => 'Potato',
                'type' => 'food',
            ],
            [
                'name' => 'Lemonade',
                'type' => 'drink',
            ],
            [
                'name' => 'Broccoli',
                'type' => 'food',
            ],
            [
                'name' => 'Soda',
                'type' => 'drink',
            ],
            [
                'name' => 'Onion',
                'type' => 'food',
            ],
            [
                'name' => 'Smoothie',
                'type' => 'drink',
            ],
        ];

        foreach ($ingredients as $ingredient) Ingredient::create($ingredient);
    }
}
