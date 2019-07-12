<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
		'uses'	=> 'WelcomeController@index',
		'as'	=> 'index'
	]);

Route::get('/about', [
		'uses'	=> 'WelcomeController@about',
		'as'	=> 'about'
	]);

Route::get('/features', [
		'uses'	=> 'WelcomeController@features',
		'as'	=> 'features'
	]);

Route::get('/newsletter', [
		'uses'	=> 'WelcomeController@newsletter',
		'as'	=> 'newsletter'
	]);

Route::get('/contact', [
		'uses'	=> 'WelcomeController@contact',
		'as'	=> 'contact'
	]);

Route::get('/contactus', [
	    'uses'	=> 'WelcomeController@contactus',
		'as'	=> 'contactus'
]);

Route::get('/privecy', [
	    'uses'	=> 'WelcomeController@privecy',
		'as'	=> 'privecy'
]);

Route::get('/terms', [
	    'uses'	=> 'WelcomeController@terms',
		'as'	=> 'terms'
]);

Route::get('/.well-known/acme-challenge/{id}', function($id){
	return $id;
});