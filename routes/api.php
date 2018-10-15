<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getComments/{id}','PagesController@getComments');
Route::get('showreplies/{id}','PagesController@showReplies');
Route::post('postComments','PagesController@postComments');
Route::post('postreplies','PagesController@postReplies');
Route::get('getallconfessions','PagesController@getAllConfessions');
