<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pos;
use App\Recipe;
use App\Recipe_detail;
use App\Option;
use App\Order;
use App\Order_detail;
use App\Order_detail_option;

class PosController extends Controller
{
    public function checkFirst( $arr, $value ) {
        foreach( $arr as $data ){
            if( $data == $value ){
                return false;
            }
        }
        return true;

    }

    public function checkRecipe( $arr, $id ){
        $result = array();
        for( $i = 0; $i < count($arr); $i++ ){
            if( $arr[$i]->recipe_id == $id ){
                $result[] = array($arr[$i]->material->name, $arr[$i]->quantity);
            }
        }
        return $result;

    }

    /**
     * 中間者ページ
     * 
     * link     : middle.blade.php 
     * data     : 
     */
    public function middle(){
        $order_detail_data = Order_detail::orderBy('id')->get();
        $recipe_detail = Recipe_detail::orderBy('recipe_id')->get();
        $option_data = Order_detail_option::orderBy('order_detail_id')->get();
        $recipe_detail_data = array();

        foreach( $order_detail_data as $data ){
            if( $this->checkFirst($recipe_detail_data, $data) ){
                $recipe_data = $this->checkRecipe($recipe_detail, $data->recipe->id);
                $recipe_detail_data[$data->recipe->name] = $recipe_data;
            }
        }

        return view('middle', ['order_detail_data' => $order_detail_data, 'recipe_detail_data' => $recipe_detail_data, 'option_data' => $option_data]);

    }

    /**
     * All_Orderページ
     * 
     * link     : all_order.blade.php 
     * data     : 
     */
    public function all(){
        $order_detail_data = Order_detail::orderBy('id')->get();
        $recipe_detail = Recipe_detail::orderBy('recipe_id')->get();
        $option_data = Order_detail_option::orderBy('order_detail_id')->get();
        $recipe_detail_data = array();

        foreach( $order_detail_data as $data ){
            if( $this->checkFirst($recipe_detail_data, $data) ){
                $recipe_data = $this->checkRecipe($recipe_detail, $data->recipe->id);
                $recipe_detail_data[$data->recipe->name] = $recipe_data;
            }
        }

        return view('all_order', ['order_detail_data' => $order_detail_data, 'recipe_detail_data' => $recipe_detail_data, 'option_data' => $option_data]);

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
     * 登録
     * 
     * link     : pos.blade.php(redirect)
     */
    public function new( Request $request ) {
        $request -> session() -> regenerateToken();
        $pos_num = $request -> pos_num;

        $now = Carbon::now();
        $pos = Pos::where('number', $pos_num)->first();

        $recipe_name = explode(",", $request -> recipe_name);
        $recipe_num = explode(",", $request -> recipe_num);
        $option_name = $request -> option_name;
        $option_num = $request -> option_num;
        $option_recipe_num = $request -> option_recipe_num;
        $other = $request -> other;

        

        // Order 登録
        $addOrder = new Order();
        $addOrder->pos_number_id = $pos->id;
        $addOrder->other = $other;
        $addOrder->end_flag = false;
        $addOrder->created_at = $now;
        $addOrder->updated_at = $now;
        $addOrder->save();

        for( $i = 0; $i < count($recipe_num); $i++ ){
            if( $recipe_num[$i] != 0 ){
                $recipe_data = Recipe::where('name', $recipe_name[$i])->first();

                $addOrderDetail = new Order_detail();
                $addOrderDetail->order_id = $addOrder->id;
                $addOrderDetail->recipe_id = $recipe_data->id;
                $addOrderDetail->drink_num = $recipe_num[$i];
                $addOrderDetail->created_at = $now;
                $addOrderDetail->updated_at = $now;
                $addOrderDetail->save();

            }
        }

        if( $option_name != "" ){
            $option_name = explode(",", $request -> option_name);
            $option_num = explode(",", $request -> option_num);
            $option_recipe = explode(",", $request -> option_recipe);

            for( $i = 0; $i < count($option_num); $i++ ){
                if( $option_num[$i] != 0 ){
                    $name_id = Recipe::where('name', $option_recipe[$i])->first();
                    $option_order_num = Order_detail::where('order_id', $addOrder->id)
                        ->where('recipe_id', $name_id->id)->count();

                    if( $option_order_num != 0 ){
                        $option_data = Option::where('name', $option_name[$i])->first();
                        $diff_price = $option_data->price;
                        $option_detail_id = Order_detail::where('order_id', $addOrder->id)
                        ->where('recipe_id', $name_id->id)->first();

                        $addOption = new Order_detail_option();
                        $addOption->order_detail_id = $option_detail_id->id;
                        $addOption->option_id = $option_data->id;
                        $addOption->diff_price = $diff_price;
                        $addOption->created_at = $now;
                        $addOption->updated_at = $now;
                        $addOption->save();
                    }
                }
            }
        }

        return redirect('/pos/' . $pos_num);

    }

    /**
     * 完了
     * 
     * link     : pos.blade.php(redirect)
     */
    public function comp( Request $request ) {
        $request -> session() -> regenerateToken();
        $order_id = $request -> order_id;

        if( $order_id != 0 ){
            $addData = Order::where('id', $order_id)->first();
            $addData->end_flag = true;
            $addData->save();
        }

        return redirect('/middle');
    }

    /**
     * バーテンページ
     * 
     * link     : bar.blade.php 
     * data     : 
     */
    public function bar( $pos_num = 201 ){
        $order_detail_data = Order_detail::orderBy('id')->get();
        $recipe_detail = Recipe_detail::orderBy('recipe_id')->get();
        $option_data = Order_detail_option::orderBy('order_detail_id')->get();
        $recipe_detail_data = array();

        foreach( $order_detail_data as $data ){
            if( $this->checkFirst($recipe_detail_data, $data) ){
                $recipe_data = $this->checkRecipe($recipe_detail, $data->recipe->id);
                $recipe_detail_data[$data->recipe->name] = $recipe_data;
            }
        }

        return view('bar', ['pos_num' => $pos_num, 'order_detail_data' => $order_detail_data, 'recipe_detail_data' => $recipe_detail_data, 'option_data' => $option_data]);

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
