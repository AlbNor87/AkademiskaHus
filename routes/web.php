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
Route::get('omoss', 'PagesController@omoss');
Route::get('posts/{id}', 'PostsController@show');
