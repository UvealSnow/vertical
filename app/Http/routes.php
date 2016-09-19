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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/pole-fitness', function () {
	return view('static.pole-fitness');
});

Route::get('/gap', function () {
	return view('static.gap');
});

Route::get('/vtraining', function () {
	return view('static.vtraining');
});

Route::get('/aerobics', function () {
	return view('static.aerobics');
});

Route::resource('medal', 'MedalController');
Route::resource('package', 'PackageController');


Route::get('/lesson/pole', 'LessonController@placeForm');
Route::post('/lesson/{id}/enroll', 'LessonController@enrollUser');
Route::resource('lesson', 'LessonController');

Route::get('/user/{id}/package', 'UserController@showAddForm');
Route::post('/user/package', 'UserController@addPackage');
Route::get('/user/list', 'UserController@listUsers');
Route::get('/user/profile', 'UserController@userProfile');
Route::post('/user/profile', 'UserController@userShow');
Route::resource('user', 'UserController');

Route::auth();
Route::get('/home', 'HomeController@index');

/*
	GET	/photo	index	photo.index
	GET	/photo/create	create	photo.create
	POST	/photo	store	photo.store
	GET	/photo/{photo}	show	photo.show
	GET	/photo/{photo}/edit	edit	photo.edit
	PUT/PATCH	/photo/{photo}	update	photo.update
	DELETE	/photo/{photo}	destroy	photo.destroy
*/
