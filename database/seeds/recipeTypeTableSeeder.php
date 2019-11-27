<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class recipeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['カスタム', '炭酸', 'その他'];
        $now = Carbon::now();
        foreach( $names as $name ){
            DB::table('recipe_types')->insert([
                'name' => $name, 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
