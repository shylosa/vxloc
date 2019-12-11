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
/*Route::get('/login', function (){
    if (Request::ajax()) {
        return 'Request from AJAX method';
    }
    return 'AuthController@loginForm';})->name('login');*/

Route::post('/login', 'AuthController@login');

Route::get('/phonebook', 'PhonebookController@index')->name('phonebook');
Route::get('/phonebook/{id}', 'PhonebookController@show')->name('phonebook.show');
Route::get('/mycontact', 'PhonebookController@mycontact')->name('phonebook.mycontact');

Route::get('/logout', 'AuthController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/', 'PhonebookController@store')->name('phonebook.store');
