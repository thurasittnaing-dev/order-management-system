<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Chinese Food',
                'image' => 'chinese_food.jpg',
                'type' => 'food',
            ],
            [
                'name' => 'Chinese Drink',
                'image' => 'chinese_drink.png',
                'type' => 'drink',
            ],
            [
                'name' => 'Japanese Food',
                'image' => 'japanese_food.jpg',
                'type' => 'food',
            ],
            [
                'name' => 'Japanese Drink',
                'image' => 'japanese_drink.png',
                'type' => 'drink',
            ],
            [
                'name' => 'Korean Food',
                'image' => 'korean_food.jpg',
                'type' => 'food',
            ],
            [
                'name' => 'Korean Drink',
                'image' => 'korean_drink.png',
                'type' => 'drink',
            ],
        ];

        foreach($categories as $category) Category::create($category);
    }
}
