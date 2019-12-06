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
Route::get('/phonebook', 'PhonebookController@index')->name('phonebook');

Route::get('/phonebook/{id}', 'PhonebookController@show')->name('phonebook.show');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
