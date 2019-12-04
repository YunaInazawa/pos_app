<?php

use Illuminate\Database\Seeder;

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
            posTableSeeder::class, 
            materialTypeTableSeeder::class, 
            recipeTypeTableSeeder::class, 
            optionTableSeeder::class, 
            materialTableSeeder::class, 
            recipeTableSeeder::class, 
            recipeDetailTableSeeder::class
        ]);
    }
}
