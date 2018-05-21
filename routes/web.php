<?php

/*
 * This file is part of Yrgo.
 *
 * (c) Yrgo, högre yrkesutbildning Göteborg.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@index');
Route::get('login', 'PagesController@login')->middleware('guest');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('help', 'PagesController@help');
Route::get('errorReport', 'PagesController@errorReport');
Route::get('malfunction', 'PagesController@malfunction');
Route::get('ideas', 'PagesController@ideas');
Route::get('posts/{id}', 'PostsController@show');
