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

// Client Routes
Route::get('/client',['as'=>'client.index','uses'=>'ClientController@index']);
Route::post('/client',['as'=>'client.store','uses'=>'ClientController@store']);
Route::get('/client/show/{id}',['as'=>'client.show','uses'=>'ClientController@show']);
Route::put('/client/edit/{id}',['as'=>'client.update','uses'=>'ClientController@update']);
Route::delete('/client/delete/{id}',['as'=>'client.delete','uses'=>'ClientController@destroy']);


// Project Note routes
Route::get('/project/{id}/note/',['as'=>'projectNotes.index','uses'=>'ProjectNoteController@index']);
Route::post('/project/{id}/note/',['as'=>'projectNotes.store','uses'=>'ProjectNoteController@store']);
Route::get('/project/{id}/note/{noteId}',['as'=>'projectNotes.index','uses'=>'ProjectNoteController@show']);
Route::put('/project/{id}/note/edit/{noteId}',['as'=>'projectNotes.update','uses'=>'ProjectNoteController@update']);
Route::delete('/project/{id}/note/delete/{noteId}',['as'=>'projectNotes.delete','uses'=>'ProjectNoteController@destroy']);

// Project Routes
Route::get('/project',['as'=>'project.index','uses'=>'ProjectController@index']);
Route::post('/project',['as'=>'project.store','uses'=>'ProjectController@store']);
Route::get('/project/show/{id}',['as'=>'project.show','uses'=>'ProjectController@show']);
Route::put('/project/edit/{id}',['as'=>'project.update','uses'=>'ProjectController@update']);
Route::delete('/project/delete/{id}',['as'=>'project.delete','uses'=>'ProjectController@destroy']);