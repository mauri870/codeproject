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

Route::post('oauth/access_token', function () {
    return response()->json(Authorizer::issueAccessToken());
});
Route::group(['middleware' => 'oauth'], function () {

    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);


    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
    Route::get('project/show/{id}', 'ProjectController@show');

    Route::group(['prefix' => 'project'], function () {

        // Project Note routes

        Route::get('{id}/note/', ['as' => 'projectNotes.index', 'uses' => 'ProjectNoteController@index']);
        Route::post('{id}/note/', ['as' => 'projectNotes.store', 'uses' => 'ProjectNoteController@store']);
        Route::get('{id}/note/{noteId}', ['as' => 'projectNotes.index', 'uses' => 'ProjectNoteController@show']);
        Route::put('{id}/note/{noteId}', ['as' => 'projectNotes.update', 'uses' => 'ProjectNoteController@update']);
        Route::delete('{id}/note/{noteId}', ['as' => 'projectNotes.delete', 'uses' => 'ProjectNoteController@destroy']);

        // Project task routes
        Route::get('{id}/task/', ['as' => 'projectTasks.index', 'uses' => 'ProjectTaskController@index']);
        Route::post('{id}/task/', ['as' => 'projectTasks.store', 'uses' => 'ProjectTaskController@store']);
        Route::get('/{id}/task/{taskId}', ['as' => 'projectTasks.index', 'uses' => 'ProjectTaskController@show']);
        Route::put('{id}/task/{taskId}', ['as' => 'projectTasks.update', 'uses' => 'ProjectTaskController@update']);
        Route::delete('{id}/task/{taskId}', ['as' => 'projectTasks.delete', 'uses' => 'ProjectTaskController@destroy']);

        // Project members Routes
        Route::get('{id}/members', ['as' => 'projectMembers.index', 'uses' => 'ProjectController@members']);

        // Project Files
       Route::post('file/','ProjectFileController@store');
       Route::delete('file/','ProjectFileController@destroy');
    });
});