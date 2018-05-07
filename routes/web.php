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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/search', function () {
    return view('search');
});
Route::get('vocabulary/search', [ 'as' => 'vocabulary.search', 'uses' => 'VocabularyController@search']);

Route::get('/find', function () {
    return view('find');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/vocabulary', 'VocabularyController');
