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

Route::post('oauth/access_token', function(){
	return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){

	Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);
	//Client
	// Route::get('client', ['middleware' => 'oauth', 'uses' => 'ClientController@index']);
	// Route::post('client', 'ClientController@store');
	// Route::get('client/{id}', 'ClientController@show');
	// Route::delete('client/{id}', 'ClientController@destroy');
	// Route::put('client/{id}', 'ClientController@update');

	Route::group(['prefix' => 'project'], function(){
		Route::resource('', 'ProjectController', ['except' => ['create', 'edit']]);

		Route::get('{id}/note', 'ProjectNoteController@index');
		Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
		Route::post('{id}/note', 'ProjectNoteController@store');
		Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');
		Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');

		//ProjectTask
		Route::get('{id}/task', 'ProjectTaskController@index');
		Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
		Route::post('{id}/task', 'ProjectTaskController@store');
		Route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');
		Route::put('{id}/task/{taskId}', 'ProjectTaskController@update');

		//ProjectMembers
		Route::post('{id}/member', 'ProjectController@addMember');
		Route::delete('{id}/member/{memberId}', 'ProjectController@removeMember');
		Route::get('{id}/member/{memberId}', 'ProjectController@isMemeber');
	});

	//ProjectNote
	// Route::get('project/{id}/note', 'ProjectNoteController@index');
	// Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
	// Route::post('project/{id}/note', 'ProjectNoteController@store');
	// Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@destroy');
	// Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');

	// //ProjectTask
	// Route::get('project/{id}/task', 'ProjectTaskController@index');
	// Route::get('project/{id}/task/{taskId}', 'ProjectTaskController@show');
	// Route::post('project/{id}/task', 'ProjectTaskController@store');
	// Route::delete('project/{id}/task/{taskId}', 'ProjectTaskController@destroy');
	// Route::put('project/{id}/task/{taskId}', 'ProjectTaskController@update');

	// //ProjectMembers
	// Route::post('project/{id}/member', 'ProjectController@addMember');
	// Route::delete('project/{id}/member/{memberId}', 'ProjectController@removeMember');
	// Route::get('project/{id}/member/{memberId}', 'ProjectController@isMemeber');

	// //Project
	// Route::get('project', 'ProjectController@index');
	// Route::post('project', 'ProjectController@store');
	// Route::get('project/{id}', 'ProjectController@show');
	// Route::delete('project/{id}', 'ProjectController@destroy');
	// Route::put('project/{id}', 'ProjectController@update');

});



