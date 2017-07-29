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

Route::group(['middleware' => ['crsauth']], function () {

    Route::get('/', 'HomeController@index');

    Route::get('/dashboard', 'HomeController@index');

	// Includes transaction routes
	require_once('transaction.php');

	// Includes transfer routes
	require_once('transfer.php');

	// Includes admin routes
	require_once('admin.php');

	// Includes admin routes
	require_once('banks.php');

});



Route::get('/theme', 'HomeController@theme');

Route::get('/login', 'AuthController@showLogin');

Route::get('/logout', 'AuthController@logout');

Route::post('/login', 'AuthController@login');