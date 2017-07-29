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

///
/// Create a middleware group here for super admin
///


Route::get('/banks', "BankController@index");

Route::get('/bank/{id}/edit', "BankController@edit");

Route::get('/bank/{id}/delete', "BankController@delete");

Route::get('/bank/add', "BankController@create");
Route::post('/bank/add', "BankController@store");



//Routes for bank accout CRUD and more ..

Route::get('/bank_accounts', "BankAccountController@index");

Route::get('/bank_account/{id}/edit', "BankAccountController@edit");

Route::get('/bank_account/{id}/delete', "BankAccountController@delete");

Route::get('/bank_account/add', "BankAccountController@create");
Route::post('/bank_account/add', "BankAccountController@store");

Route::get('/bank_account/{bank_id}', "BankAccountController@listAccounts");





