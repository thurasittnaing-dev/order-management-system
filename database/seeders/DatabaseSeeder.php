<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\OrderTableSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\IngredientSeeder;
use Database\Seeders\RecipeSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            RoomSeeder::class,
            OrderTableSeeder::class,
            IngredientSeeder::class,
            RecipeSeeder::class,

        ]);
    }
}
