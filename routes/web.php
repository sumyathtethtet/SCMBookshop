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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home','HomeController@index');

//login
Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login', 'Auth\LoginController@login');

//register

Route::get('/register/email', 'Auth\RegisterController@mail');
Route::get('/logout','Auth\LoginController@logout');

Auth::routes();
//Auth::routes(['verify' => true]);

