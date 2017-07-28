<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register transaction web routes for your application. These
| routes are  by the web base route
| contains the "web" middleware group. Now create something great!
|
*/

/**
* List all Prepayments
*/
Route::get('/transfer', 'TransferController@index');