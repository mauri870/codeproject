<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client',['as'=>'home.index','uses'=>'ClientController@index']);
Route::post('/client',['as'=>'home.store','uses'=>'ClientController@store']);
Route::get('/client/show/{id}',['as'=>'home.show','uses'=>'ClientController@show']);
Route::delete('/client/delete/{id}',['as'=>'home.delete','uses'=>'ClientController@delete']);
