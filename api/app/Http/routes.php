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

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix'=> 'client', 'except' => ['create', 'edit']], function() {
    Route::get('', ['as' => 'client', 'uses' => 'ClientController@index']);
    Route::post('', ['as' => 'client.store', 'uses' => 'ClientController@store']);
    Route::get('{id}', ['as' => 'client.show', 'uses' => 'ClientController@show']);
    Route::put('{id}', ['as' => 'client.update', 'uses' => 'ClientController@update']);
    Route::delete('{id}', ['as' => 'client.destroy', 'uses' => 'ClientController@destroy']);
    //Route::get('create', ['as' => 'client.create', 'uses' => 'ClientController@create']);
    //Route::get('{id}/edit', ['as' => 'client.edit', 'uses' => 'ClientController@edit']);
});
Route::group(['prefix'=> 'project', 'except' => ['create', 'edit']], function() {

    Route::get('{id}/members', ['as' => 'project_members', 'uses' => 'ProjectMemberController@members']);
    Route::post('{id}/members', ['as' => 'projectmembers.add', 'uses' => 'ProjectMemberController@add']);
    Route::delete('{id}/members/{memberId}', ['as' => 'project_members.remove', 'uses' => 'ProjectMemberController@remove']);

    Route::get('{id}/note', ['as' => 'project_note', 'uses' => 'ProjectNoteController@index']);
    Route::post('{id}/note', ['as' => 'project_note.store', 'uses' => 'ProjectNoteController@store']);
    Route::get('{id}/note/{noteId}', ['as' => 'project_note.show', 'uses' => 'ProjectNoteController@show']);
    Route::put('{id}/note/{noteId}', ['as' => 'project_note.update', 'uses' => 'ProjectNoteController@update']);
    Route::delete('{id}/note/{noteId}', ['as' => 'project_note.destroy', 'uses' => 'ProjectNoteController@destroy']);

    Route::get('{id}/task', ['as' => 'project_task', 'uses' => 'ProjectTaskController@index']);
    Route::post('{id}/task', ['as' => 'project_task.store', 'uses' => 'ProjectTaskController@store']);
    Route::get('{id}/task/{taskId}', ['as' => 'project_task.show', 'uses' => 'ProjectTaskController@show']);
    Route::put('{id}/task/{taskId}', ['as' => 'project_task.update', 'uses' => 'ProjectTaskController@update']);
    Route::delete('{id}/task/taskId}', ['as' => 'project_task.destroy', 'uses' => 'ProjectTaskController@destroy']);

    Route::get('{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
    Route::put('{id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
    Route::delete('{id}', ['as' => 'project.destroy', 'uses' => 'ProjectController@destroy']);
    //Route::get('{id}/edit', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
    //Route::get('create', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
    Route::get('', ['as' => 'project', 'uses' => 'ProjectController@index']);
    Route::post('', ['as' => 'project.store', 'uses' => 'ProjectController@store']);

});