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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'MainController@index');
Route::get('/login', 'AuthController@loginForm')->name('login');

Route::post('/login', 'AuthController@login');

Route::get('/phonebook', 'PhonebookController@index')->name('phonebook');
Route::get('/phonebook/{id}', 'PhonebookController@index')->name('show');

Route::get('/mycontact', 'PhonebookController@mycontact')->name('mycontact');
Route::post('/mycontact', 'PhonebookController@mycontact');
Route::post('/store', 'PhonebookController@store')->name('store');

Route::get('/logout', 'AuthController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add-phone', 'PhonebookController@addPhone');
Route::get('/add-email', 'PhonebookController@addEmail');
