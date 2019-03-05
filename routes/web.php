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

Auth::routes();
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
Route::post('/register','Auth\RegisterController@register');

//author
Route::get('/list-author','Author\AuthorController@index');

//new author add
Route::get('/add-author',function() {
    return view('author.add-author');
});
Route::post('/add-author','Author\AuthorController@store');

//edit author
Route::get('/edit-author/{authoredit_id}','Author\AuthorController@edit');
Route::post('/update-author','Author\AuthorCOntroller@update');

//delete author
Route::get('/delete-author/{authordelete_id}','Author\AuthorController@destroy');

//
Route::post('/search','Author\Authorcontroller@index');
Route::get('/pagination', 'Author\Authorcontroller@index');



