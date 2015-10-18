<?php

/**
 * SITE FRONT END PAGES
 */
Route::get('/', 'PagesController@home');



/**
 * ADMINISTRATOR
 */
Route::get('admin', 'AdminController@index');




/**
 * ------------------------
 * LARAVEL AUTH controllers
 * ------------------------
 * login
 * social users
 * register
 * psw reset
 * logout
 */
Route::get('login', 	'Auth\AuthController@getLogin');
Route::post('login', 	'Auth\AuthController@postLogin');
Route::get('logout', 	'Auth\AuthController@getLogout');

Route::get('login/{provider}', 'Auth\AuthController@loginWithProvider');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('profile', 'ProfileController@index');
Route::get('profile/{user}', 'ProfileController@show');
Route::get('profile/{user}/edit', 'ProfileController@edit');




/**
 * Levels  
 */
Route::get('admin/levels/create', 			'LevelsController@create');
Route::get('admin/levels/{levels}/edit', 	'LevelsController@edit');
Route::post('admin/levels', 				'LevelsController@store'); 
Route::get('admin/levels', 					'LevelsController@index'); 


Route::get('admin/levels/getjson',			'levelsController@getLevels');
Route::get('admin/levels/{levels}',			'LevelsController@show'); 
// Route::resource('levels', 'LevelsController');



/**
 * Create Lessons
 *
 * @create
 * @store
 */
Route::get('lessons/create', 'LessonsController@create');
Route::post('lessons', 'LessonsController@store');


/**
 * EDIT LESSONS
 *
 * @edit
 * @update
 * @destroy
 */
Route::get('lessons/{lesson}/edit', 'LessonsController@edit');
Route::put('lessons/{lesson}', 'LessonsController@update');
Route::delete('lessons/{lesson}', 'LessonsController@destroy');
// Route::patch('lessons/{lesson}', 'LessonsController@update');



/**
 * view Lessons
 *
 * @index 	
 * @show
 */
Route::get('{level}/lessons/', 'LessonsController@index');
Route::get('{level}/lessons/{lesson}', 'LessonsController@show');







/*
|-----------------
| MY NOTES:
|-----------------
|
*/





/**
* levels 			-> route: url string 
* LevelsController 	-> controller class name
* index 			-> mothod name to call inside the controller class 	
*/
// Route::get('levels', 'LevelsController@index');


/**
* display the create form
*/
// Route::get('levels/create', 'LevelsController@create');



/**
* pass the id of the level to load*
*/
// Route::get('levels/{id}', 'LevelsController@show');



/**
 * add new Levels to the db
 */
// Route::post('levels', 'LevelsController@store');



/**
 * edit selected level
 */
// Route::get('levels/{id}/edit', 'LevelsController@edit'); 




/* laravel route auth 4.2
Route::controllers([
	'auth' 		=> 'Auth\AuthController',
	'password'	=> 'Auth\PasswordController', 
]);
*/