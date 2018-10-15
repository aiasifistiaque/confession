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

Route::get('/example', function () {
    return view('welcome');
});

Route::get('/','PagesController@homePage');
Route::get('/post','PagesController@postPage');
Route::post('/postsecret','PagesController@postSecret');
Route::get('/read','PagesController@readSecret');
Route::get('/read/{id}','PagesController@readPost');

Route::get('/viewall', function () {
    return view('pages.viewall');
});
