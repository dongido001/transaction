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

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index');
    Route::get('/banks', 'AdminController@banks');
    Route::get('/bank/{edit}', 'AdminController@editBank');
    Route::get('/bank/{add}', 'AdminController@addBank');
    Route::get('/bank/search/{query?}', 'AdminController@searchBank');
});