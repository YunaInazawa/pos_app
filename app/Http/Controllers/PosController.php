<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pos;
use App\Recipe;
use App\Option;
use App\Order;
use App\Order_detail;

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

    public function new( Request $request ) {
        $request -> session() -> regenerateToken();
        $pos_num = $request -> pos_num;

        $now = Carbon::now();
        $recipe_name = $request -> recipe_name;
        $recipe_num = $request -> recipe_num;
        $other = $request -> other;

        $pos = Pos::where('number', $pos_num)->first();

        // Order 登録
        $addOrder = new Order();
        $addOrder->pos_number_id = $pos->id;
        $addOrder->other = $other;
        $addOrder->created_at = $now;
        $addOrder->updated_at = $now;
        $addOrder->save();

        $recipe = explode(",", $recipe_name);
        $num = explode(",", $recipe_num);
        for( $i = 0; $i < count($num); $i++ ){
            if( $num[$i] != 0 ){
                $recipe_data = Recipe::where('name', $recipe[$i])->first();

                $addOrderDetail = new Order_detail();
                $addOrderDetail->order_id = $addOrder->id;
                $addOrderDetail->recipe_id = $recipe_data->id;
                $addOrderDetail->drink_num = $num[$i];
                $addOrderDetail->created_at = $now;
                $addOrderDetail->updated_at = $now;
                $addOrderDetail->save();
            }
        }


        return redirect('/pos/' . $pos_num);

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
