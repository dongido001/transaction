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


//Routes for Transfer CRUD and more ..

Route::get('/transfer', "TransferController@index");

Route::get('/transfer/single', "TransferController@single");
Route::post('/transfer/single', "TransferController@single");
Route::post('/transfer/api_single', "TransferController@apiSingleTransfer");
Route::post('/transfer/comfirm_otp', "TransferController@comfirmOtp");

Route::get('/transfer/bulk', "TransferController@bulk");

Route::get('/transfer/history', "TransferController@history");