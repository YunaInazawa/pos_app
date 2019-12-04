<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pos;

class TopController extends Controller
{
    /**
     * トップページ
     * 
     * link     : top.blade.php
     * data     : pos_data => Pos::all()
     */
    public function index() {
        $pos_data = Pos::all();

        return view('top', ['pos_data' => $pos_data]);

    }
}
