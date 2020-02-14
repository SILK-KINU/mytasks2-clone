<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
    // Route::get('tasks/create', 'Admin\TasksController@add');
    
    Route::get('tasks/create', 'Admin\TasksController@add');
    Route::post('tasks/create', 'Admin\TasksController@create');
    Route::get('tasks', 'Admin\TasksController@index');
    Route::get('tasks/edit', 'Admin\TasksController@edit');
    Route::post('tasks/edit', 'Admin\TasksController@update');
    Route::get('tasks/delete', 'Admin\TasksController@delete');
});
Auth::routes();

Route::get('/', 'TasksController@index');

Route::get('tasks/timeline', 'TasksController@tweet');   
Route::post('/tasks/timeline', 'TasksController@postTweet'); 

Route::get('tasks/search','TasksController@search');
Route::post('tasks/search','TasksController@search');

Route::get('tasks/recommend','TasksController@recommend');