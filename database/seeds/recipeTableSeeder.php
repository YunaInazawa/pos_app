<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class recipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'カスタム', 
            'シャーリー・テンプル', 'ベリーチェリーソーダ', 'アップルジンジャー', 'レッドドラゴン', 'ヴァージンジン・ジャーミモザ', 'スッパイシー', 'マリンレモネード', 'ロシアンハート', 'ココ', 
            'HOTレモネード', 'カシスオレンジ', 'サングリア', 'シンデレラ', 'プシーキャット', 'ざくろグレープフルーツ', 'セーフ・セックス・オン・ザ・ビーチ', 'チャイナブルー', 'ブラッディマンディ'
        ];
        $types = [
            'カスタム', 
            '炭酸', '炭酸', '炭酸', '炭酸', '炭酸', '炭酸', '炭酸', '炭酸', '炭酸',  
            'その他', 'その他', 'その他', 'その他', 'その他', 'その他', 'その他', 'その他', 'その他'
        ];
        $prices = [
            '50', 
            '50', '80', '50', '50', '80', '80', '80', '50', '50', 
            '80', '80', '80', '80', '80', '50', '50', '50', '50'
        ];
        $now = Carbon::now();
        for( $i = 0; $i < count($names); $i++ ){
            $type = DB::table('recipe_types')->where('name', $types[$i])->first();

            DB::table('recipes')->insert([
                'name' => $names[$i],
                'recipe_type_id' => $type->id, 
                'price' => $prices[$i], 
                'created_at' => $now, 
                'updated_at' => $now
            ]);
        }
    }
}
