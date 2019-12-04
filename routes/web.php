<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TopController@index')              -> name('top');
Route::get('/middle', 'PosController@middle')       -> name('middle');
Route::get('/pos/{pos_num}','PosController@pos')    -> name('pos');
Route::get('/bar/{pos_num}', 'PosController@bar')   -> name('bar');
Route::post('check', 'PosController@check')         -> name('check');
Route::get('/edit', 'MgrController@index')          -> name('edit');
Route::get('/edit_pos', 'MgrController@pos')        -> name('edit.pos');
Route::get('/edit_mate', 'MgrController@mate')      -> name('edit.mate');
Route::get('/edit_recipe', 'MgrController@recipe')  -> name('edit.recipe');
