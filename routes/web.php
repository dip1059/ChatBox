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

Route::get('admin', function () {
    return view('welcome');
});
Route::post('inorup','CrudCont@inOrUp');
Route::post('read','CrudCont@read');
Route::post('delete','CrudCont@del');


Route::get('/','ChatCont@index');
Route::post('login','ChatCont@login');
Route::post('logout','ChatCont@logout');
Route::post('load','ChatCont@load');
Route::post('ldmsg','ChatCont@ldmsg');
Route::post('sndmsg','ChatCont@sndmsg');