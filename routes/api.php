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

// List posts
Route::get('posts', 'PostController@index');

// List single post
Route::get('post/{id}', 'PostController@show');

// Create new post
Route::post('post', 'PostController@store');

// Update post
Route::put('post', 'PostController@store');

// Delete 
Route::delete('post/{id}', 'PostController@destroy');


// List malfunctions
Route::get('malfunctions', 'MalfunctionController@index');

// List single malfunction
Route::get('malfunction/{id}', 'MalfunctionController@show');

// Create malfunction
Route::post('malfunction', 'MalfunctionController@store');

// Update malfunction
Route::put('malfunction', 'MalfunctionController@store');

// Delete malfunction
Route::delete('malfunction/{id}', 'MalfunctionController@destroy');