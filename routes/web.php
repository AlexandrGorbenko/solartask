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
    return view('index');
});

Route::post('/comments', 'CommentsController@index')->name('comments.index');
Route::post('/comments/store', 'CommentsController@store')->name('comments.store');
Route::post('/comments/{id}/update', 'CommentsController@update')->name('comments.update');
Route::post('/comments/{id}/delete', 'CommentsController@delete')->name('comments.delete');