<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function middle(){
        return view('middle');

    }

    public function pos( $pos_num = 101 ){
        return view('pos', ['pos_num' => $pos_num]);

    }

    public function bar( $pos_num = 201 ){
        return view('bar', ['pos_num' => $pos_num]);

    }

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
