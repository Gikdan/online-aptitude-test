<?php

Route::group(['prefix' => 'v1'], function() {
	Route::group(['middleware' => 'guest'], function() {
		Route::post('login', 'AuthController@login');
	});

	Route::group(['middleware' => 'auth:api'], function() {
		Route::post('logout', 'AuthController@logout');
		Route::get('init', 'AuthController@init');


		Route::put('users/{id}/auth', 'UsersController@auth');
		Route::resource('users', 'UsersController');

		Route::resource('user-types', 'UserTypeController');

		Route::resource('applicants', 'ApplicantsController');
		Route::resource('categories', 'CategoriesController');
		Route::resource('questions', 'QuestionsController');
	});
});

Route::any('{path?}', function() {
	return 'API working.';
});