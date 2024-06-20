<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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
                'image' => 'chinese_food.png',
                'type' => 'food',
            ],
            [
                'name' => 'Chinese Drink',
                'image' => 'chinese_drink.png',
                'type' => 'drink',
            ],
            [
                'name' => 'Japanese Food',
                'image' => 'japanese_food.png',
                'type' => 'food',
            ],
            [
                'name' => 'Japanese Drink',
                'image' => 'japanese_drink.png',
                'type' => 'drink',
            ],
            [
                'name' => 'Korean Food',
                'image' => 'korean_food.png',
                'type' => 'food',
            ],
            [
                'name' => 'Korean Drink',
                'image' => 'korean_drink.png',
                'type' => 'drink',
            ],
        ];

        foreach ($categories as $categoryData) {
            $filename = $this->uploadImageFile($categoryData['image']);
            $categoryData['image'] = $filename;
            Category::create($categoryData);
        };
    }

    public function uploadImageFile($filename)
    {
        $extension = '.png';
        $storedFileName = null;
        $defaultFileLocation = public_path('images/default_categories/' . $filename);

        if (file_exists($defaultFileLocation)) {
            $fileContents = file_get_contents($defaultFileLocation);
            $storedFileName = uniqid() . $extension;
            $destinationPath = 'public/categories/' . $storedFileName;
            Storage::put($destinationPath, $fileContents);
        }

        return $storedFileName;
    }
}
