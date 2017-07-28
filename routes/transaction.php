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

Route::get('/gg', function () {
    return view('index');
});


Route::get('/empty', function () {
    return view('empty');
});

/**
* List all transactions
*/
Route::get('/transactions', 'TransactionController@index');

/**
* List all Prepayments
*/
Route::get('/transactions/prepayments', 'TransactionController@prepayments');