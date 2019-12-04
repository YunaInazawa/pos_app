<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Option;

class PosController extends Controller
{
    /**
     * 中間者ページ
     * 
     * link     : middle.blade.php 
     * data     : 
     */
    public function middle(){
        return view('middle');

    }

    /**
     * レジページ
     * - pos_num    : POS番号
     * 
     * link     : pos.blade.php 
     * data     : pos_num       => POS番号
     *            recipe_data   => Resipe::all()
     *            option        => Option::all()
     */
    public function pos( $pos_num = 101 ){
        $recipe_data = Recipe::all();
        $option_data = Option::all();

        return view('pos', ['pos_num' => $pos_num, 'recipe_data' => $recipe_data, 'option_data' => $option_data]);

    }

    /**
     * バーテンページ
     * 
     * link     : bar.blade.php 
     * data     : 
     */
    public function bar( $pos_num = 201 ){
        return view('bar', ['pos_num' => $pos_num]);

    }

    /**
     * TOP から POS or BAR への遷移先チェック
     * （pos_num が 1* なら POS、2* なら BAR）
     * - pos_num    : POS番号
     * 
     * link     : redirect( POS or BAR )
     * data     : 
     */
    public function check( Request $request ){
        $request -> session() -> regenerateToken();
        $pos_num = $request -> pos_num;
        $first_str = substr($pos_num, 0, 1);
        if( $first_str == "1" ){
            return redirect('/pos/' . $pos_num);
        } else {
            return redirect('/bar/' . $pos_num);
        }
    }
}
