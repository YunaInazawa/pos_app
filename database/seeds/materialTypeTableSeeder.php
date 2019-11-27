<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class materialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['果実飲料', '炭酸飲料', 'シロップ', 'トッピング', 'その他'];
        $now = Carbon::now();
        foreach( $names as $name ){
            DB::table('material_types')->insert([
                'name' => $name, 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
