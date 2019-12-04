<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pos;
use App\Material;
use App\Recipe;

class MgrController extends Controller
{
    /**
     * 管理者ページ
     * （情報の編集、売上確認など）
     * 
     * link     : admin.blade.php 
     */
    public function index(){
        return view('admin');

    }

    /**
     * POS 編集ページ
     * （POS の追加、変更、削除など）
     * 
     * link     : edit_pos.blade.php 
     * data     : pos_data => Pos::all()
     */
    public function pos(){
        $pos_data = Pos::all();

        return view('edit_pos', ['pos_data' => $pos_data]);

    }

    /**
     * 材料 編集ページ
     * （材料の追加、変更、削除など）
     * 
     * link     : edit_material.blade.php 
     * data     : mate_data => Material::all()
     */
    public function mate(){
        $mate_data = Material::all();
        $message = "EDIT_MATERIAL";

        return view('edit_material', ['message' => $message, 'mate_data' => $mate_data]);

    }

    /**
     * レシピ 編集ページ
     * （レシピの追加、変更、削除など）
     * 
     * link     : edit_recipe.blade.php 
     * data     : recipe_data => Recipe::all()
     */
    public function recipe(){
        $recipe_data = Recipe::all();
        $message = "EDIT_RECIPE";

        return view('edit_recipe', ['message' => $message, 'recipe_data' => $recipe_data]);

    }
}
