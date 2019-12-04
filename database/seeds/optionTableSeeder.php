<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class optionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['氷無し', 'トッピング無し', 'トッピング追加(オレンジ)', 'トッピング追加(レモン)', 'トッピング追加(ライム)', 'トッピング追加(ミックスベリー)', '割引券', 'その他'];
        $prices = ['0', '-30', '30', '30', '30', '30', '-30', '0'];
        $now = Carbon::now();
        for( $i = 0; $i < count($names); $i++ ){
            DB::table('options')->insert([
                'name' => $names[$i],
                'price' => $prices[$i], 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
