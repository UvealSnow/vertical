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

Route::get('/calendar', 'CalendarController@showCalendar');

Route::resource('medal', 'MedalController');

Route::resource('package', 'PackageController');

Route::resource('lecture', 'LectureController'); # this is the new main model controller

Route::get('/diet/re-assign/{diet_id}', 'DietController@reAssignForm');
Route::post('/diet/re-assign/{diet_id}', 'DietController@reAssignPost');
Route::resource('diet', 'DietController');

Route::get('/lecture/{lecture_id}/agenda/{agenda_id}/enrolled', 'AgendaController@seeEnrolled');
Route::get('/lecture/{lecture_id}/agenda/{agenda_id}/enroll', 'AgendaController@enroll');
Route::post('/lecture/{lecture_id}/agenda/{agenda_id}', 'AgendaController@enrollUser');
Route::resource('/lecture/{lecture_id}/agenda','AgendaController', ['except' => ['create', 'show', 'edit', 'update']]);

Route::get('/user/{id}/package', 'UserController@showAddForm');
Route::post('/user/package', 'UserController@addPackage');
Route::get('/user/list', 'UserController@listUsers');
Route::get('/user/profile', 'UserController@userProfile');
Route::post('/user/profile', 'UserController@userShow');
Route::get('/user/{uid}/medal', 'UserController@medalForm');
Route::post('/user/{uid}/medal', 'UserController@giveMedal');
Route::resource('/user/{uid}/details', 'DetailController', ['except' => ['index', 'destoy']]);
Route::resource('user', 'UserController');

Route::auth();
Route::get('/home', 'HomeController@index');

# Json routes
	
	Route::get('/json/checkIfEnrolled/{agenda_id}/{day_id}', 'AgendaController@checkIfEnrolled');
	Route::get('/json/getPoles/{agenda_id}/{day_id}', 'AgendaController@poleStatus');
	Route::get('/json/getEnrolled/{agenda_id}/{day_id}', 'AgendaController@enrolledUsers');

/*
	GET	/photo	index	photo.index
	GET	/photo/create	create	photo.create
	POST	/photo	store	photo.store
	GET	/photo/{photo}	show	photo.show
	GET	/photo/{photo}/edit	edit	photo.edit
	PUT/PATCH	/photo/{photo}	update	photo.update
	DELETE	/photo/{photo}	destroy	photo.destroy
*/
