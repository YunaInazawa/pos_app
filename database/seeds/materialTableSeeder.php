<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class materialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '炭酸水', 'コーラ', 'ジンジャエール', 
            'ぶどうジュース', 'ピーチネクター', 'クランベリージュース', 'オレンジジュース', 'りんごジュース', 'グレープフルーツジュース', 'パイナップルジュース', 
            'ガムシロップ', 'サングリアシロップ', 'カシスシロップ', 'ブルーハワイシロップ', 'グレナデンシロップ', 
            'レモン', 'オレンジ', 'ライム', 'ミント', 'ミックスベリー', 
            'レモネードミックス', '紅茶', 'コーヒー', 'レモン果汁', 'ライム果汁'
        ];
        $types = [
            '炭酸飲料', '炭酸飲料', '炭酸飲料', 
            '果実飲料', '果実飲料', '果実飲料', '果実飲料', '果実飲料', '果実飲料', '果実飲料', 
            'シロップ', 'シロップ', 'シロップ', 'シロップ', 'シロップ', 
            'トッピング', 'トッピング', 'トッピング', 'トッピング', 'トッピング', 
            'その他', 'その他', 'その他', 'その他', 'その他'
        ];
        $now = Carbon::now();

        for( $i = 0; $i < count($names); $i++ ){
            $type = DB::table('material_types')->where('name', $types[$i])->first();

            DB::table('materials')->insert([
                'name' => $names[$i],
                'material_type_id' => $type->id, 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
