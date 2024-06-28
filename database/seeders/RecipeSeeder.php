<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('categories')->pluck('id', 'name')->toArray();

        $recipes = [
            [
                'name' => 'Kung Pao Chicken',
                'image' => 'kung_pao_chicken.jpg',
                'description' => 'Spicy stir-fried Chinese dish made with chicken, peanuts, and vegetables.',
                'category_id' => $categories['Chinese Food'],
                'amount' => 12000,
                'discount' => 2000,
                'status' => 'active',
            ],
            [
                'name' => 'Bubble Tea',
                'image' => 'bubble_tea.jpg',
                'description' => 'Popular Chinese tea-based drink with chewy tapioca balls.',
                'category_id' => $categories['Chinese Drink'],
                'amount' => 5000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Dim Sum',
                'image' => 'dim_sum.jpg',
                'description' => 'A variety of small Chinese dishes traditionally enjoyed in restaurants.',
                'category_id' => $categories['Chinese Food'],
                'amount' => 10000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Green Tea',
                'image' => 'green_tea.jpg',
                'description' => 'Traditional Chinese tea known for its health benefits.',
                'category_id' => $categories['Chinese Drink'],
                'amount' => 8000,
                'discount' => 500,
                'status' => 'active',
            ],
            [
                'name' => 'Peking Duck',
                'image' => 'peking_duck.jpg',
                'description' => 'A famous Chinese duck dish known for its crispy skin.',
                'category_id' => $categories['Chinese Food'],
                'amount' => 35000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Baijiu',
                'image' => 'baijiu.jpg',
                'description' => 'A strong Chinese alcoholic drink made from grain.',
                'category_id' => $categories['Chinese Drink'],
                'amount' => 3000,
                'discount' => 100,
                'status' => 'active',
            ],
            [
                'name' => 'Sushi Platter',
                'image' => 'sushi_platter.jpg',
                'description' => 'A variety of fresh sushi.',
                'category_id' => $categories['Japanese Food'],
                'amount' => 15000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Sake',
                'image' => 'sake.jpg',
                'description' => 'Traditional Japanese rice wine.',
                'category_id' => $categories['Japanese Drink'],
                'amount' => 10000,
                'discount' => 1000,
                'status' => 'active',
            ],
            [
                'name' => 'Ramen',
                'image' => 'ramen.jpg',
                'description' => 'Japanese noodle soup dish.',
                'category_id' => $categories['Japanese Food'],
                'amount' => 6000,
                'discount' => 700,
                'status' => 'active',
            ],
            [
                'name' => 'Matcha Tea',
                'image' => 'matcha_tea.jpg',
                'description' => 'Traditional Japanese powdered green tea.',
                'category_id' => $categories['Japanese Drink'],
                'amount' => 5500,
                'discount' => 500,
                'status' => 'active',
            ],
            [
                'name' => 'Tempura',
                'image' => 'tempura.jpg',
                'description' => 'Battered and deep-fried seafood and vegetables.',
                'category_id' => $categories['Japanese Food'],
                'amount' => 15000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Umeshu',
                'image' => 'umeshu.jpg',
                'description' => 'Japanese plum wine.',
                'category_id' => $categories['Japanese Drink'],
                'amount' => 9000,
                'discount' => 200,
                'status' => 'active',
            ],
            [
                'name' => 'Spicy Korean Chicken',
                'image' => 'spicy_korean_chicken.jpg',
                'description' => 'Delicious spicy chicken with a Korean twist.',
                'category_id' => $categories['Korean Food'],
                'amount' => 8000,
                'discount' => 500,
                'status' => 'active',
            ],
            [
                'name' => 'Korean Soju',
                'image' => 'korean_soju.jpg',
                'description' => 'Popular Korean distilled beverage.',
                'category_id' => $categories['Korean Drink'],
                'amount' => 7000,
                'discount' => 1000,
                'status' => 'active',
            ],
            [
                'name' => 'Bibimbap',
                'image' => 'bibimbap.jpg',
                'description' => 'A mixed rice dish with vegetables and meat.',
                'category_id' => $categories['Korean Food'],
                'amount' => 5000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Bokbunja Ju',
                'image' => 'bokbunja_ju.jpg',
                'description' => 'Korean black raspberry wine.',
                'category_id' => $categories['Korean Drink'],
                'amount' => 11000,
                'discount' => 1000,
                'status' => 'active',
            ],
            [
                'name' => 'Kimchi',
                'image' => 'kimchi.jpg',
                'description' => 'Fermented vegetables, often spicy.',
                'category_id' => $categories['Korean Food'],
                'amount' => 4000,
                'discount' => 0,
                'status' => 'active',
            ],
            [
                'name' => 'Makgeolli',
                'image' => 'makgeolli.jpg',
                'description' => 'Traditional Korean rice wine.',
                'category_id' => $categories['Korean Drink'],
                'amount' => 3000,
                'discount' => 100,
                'status' => 'active',
            ],
        ];

        // DB::table('recipes')->insert($recipes);
        foreach ($recipes as $recipe) {
            $filename = $this->uploadImageFile($recipe['image']);
            $recipe['image'] = $filename;
            Recipe::create($recipe);
        }
    }

    public function uploadImageFile($filename)
    {
        $extension = '.png';
        $storedFileName = '-';
        $defaultFileLocation = public_path('images/default_recipes/' . $filename);

        if (file_exists($defaultFileLocation)) {
            $fileContents = file_get_contents($defaultFileLocation);
            $storedFileName = uniqid() . $extension;
            $destinationPath = 'public/recipes/' . $storedFileName;
            Storage::put($destinationPath, $fileContents);
        }

        return $storedFileName;
    }
}

