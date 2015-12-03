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

Route::post('oauth/access_token',function(){
    return response()->json(Authorizer::issueAccessToken());
});
Route::group(['middleware' => 'oauth'], function () {
    // Client Routes
    Route::get('/client',['as'=>'client.index','uses'=>'ClientController@index']);
    Route::post('/client',['as'=>'client.store','uses'=>'ClientController@store']);
    Route::get('/client/{id}',['as'=>'client.show','uses'=>'ClientController@show']);
    Route::put('/client/{id}',['as'=>'client.update','uses'=>'ClientController@update']);
    Route::delete('/client/{id}',['as'=>'client.delete','uses'=>'ClientController@destroy']);


    // Project Note routes
    Route::get('/project/{id}/note/',['as'=>'projectNotes.index','uses'=>'ProjectNoteController@index']);
    Route::post('/project/{id}/note/',['as'=>'projectNotes.store','uses'=>'ProjectNoteController@store']);
    Route::get('/project/{id}/note/{noteId}',['as'=>'projectNotes.index','uses'=>'ProjectNoteController@show']);
    Route::put('/project/{id}/note/{noteId}',['as'=>'projectNotes.update','uses'=>'ProjectNoteController@update']);
    Route::delete('/project/{id}/note/{noteId}',['as'=>'projectNotes.delete','uses'=>'ProjectNoteController@destroy']);

    // Project task routes
    Route::get('/project/{id}/task/',['as'=>'projectTasks.index','uses'=>'ProjectTaskController@index']);
    Route::post('/project/{id}/task/',['as'=>'projectTasks.store','uses'=>'ProjectTaskController@store']);
    Route::get('/project/{id}/task/{taskId}',['as'=>'projectTasks.index','uses'=>'ProjectTaskController@show']);
    Route::put('/project/{id}/task/{taskId}',['as'=>'projectTasks.update','uses'=>'ProjectTaskController@update']);
    Route::delete('/project/{id}/task/{taskId}',['as'=>'projectTasks.delete','uses'=>'ProjectTaskController@destroy']);

    // Project Routes
    Route::get('/project',['as'=>'project.index','uses'=>'ProjectController@index']);
    Route::post('/project',['as'=>'project.store','uses'=>'ProjectController@store']);
    Route::get('/project/{id}',['as'=>'project.show','uses'=>'ProjectController@show']);
    Route::put('/project/{id}',['as'=>'project.update','uses'=>'ProjectController@update']);
    Route::delete('/project/{id}',['as'=>'project.delete','uses'=>'ProjectController@destroy']);

    // Project members Routes
    Route::get('/project/{id}/members',['as'=>'projectMembers.index','uses'=>'ProjectController@members']);
});