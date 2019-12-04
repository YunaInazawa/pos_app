<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MgrController extends Controller
{
    public function index(){
        return view('admin');

    }

    public function pos(){
        return view('edit_pos');

    }

    public function mate(){
        return view('edit_recipe', ['data' => 'EDIT_MATERIAL']);

    }

    public function recipe(){
        return view('edit_recipe', ['data' => 'EDIT_RECIPE']);

    }
}
