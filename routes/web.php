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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
});

//login
Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', 'Auth\LoginController@login');

//googleLogin
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

//register
Route::post('/register', 'Auth\RegisterController@register');

//author
Route::get('/list-author', 'Author\AuthorController@index');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/add-author', function () {
        return view('author.add-author');
    });
});

Route::post('/add-author', 'Author\AuthorController@store');
Route::get('/edit-author/{authoredit_id}', 'Author\AuthorController@edit');
Route::post('/update-author', 'Author\AuthorCOntroller@update');
Route::get('/delete-author/{authordelete_id}', 'Author\AuthorController@destroy');
Route::post('/list-author', 'Author\Authorcontroller@index');

//genre

Route::group(['middleware' => ['admin']], function () {
    Route::get('/add-genre', function () {
        return view('genre.add-genre');
    });
});

Route::get('/list-genre', 'Genre\GenreController@index');
Route::post('/add-genre', 'Genre\GenreController@store');
Route::get('/edit-genre/{genreedit_id}', 'Genre\GenreController@edit');
Route::post('/update-genre', 'Genre\GenreCOntroller@update');
Route::get('/delete-genre/{genredelete_id}', 'Genre\GenreController@destroy');
Route::post('/list-genre', 'Genre\GenreController@index');

//book
Route::group(['middleware' => ['auth']], function () {
    Route::get('/list-book', 'Book\BookController@index');
    Route::post('/search-book', 'Book\BookController@index');
    Route::get('/pagination', 'Book\BookController@index');
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/add-book', 'Book\BookController@show');
    Route::post('/add-book', 'Book\BookController@store');
    Route::get('/edit-book/{bookedit_id}', 'Book\BookController@edit');
    Route::post('/update-book', 'Book\BookController@update');
    Route::get('/delete-book/{bookdelete_id}', 'Book\BookController@destroy');
    Route::post('/import', 'Book\BookController@uploadFile');
    Route::get('/download-excel', 'Book\BookController@downloadFile');
});

Route::group(['middleware' => ['user']], function () {
    Route::get('/detail-book/{book_id}', 'Book\BookController@showDetail');
    Route::get('/list-cart/{id}', 'Cart\CartController@addToCart');
    Route::get('/list-cart', 'Cart\CartController@getCart');
    Route::get('/remove-cart/{id}', 'Cart\CartController@removeCart');
    Route::get('/clear-cart', 'Cart\CartController@clearCart');
    Route::post('/confirm-cart', 'Cart\CartController@confirmBook');
    Route::get('/list-order', 'Cart\CartController@orderBook');
    Route::get('/confirm-book', 'Cart\CartController@confirm');
});
