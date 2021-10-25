<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/','App\Http\Controllers\HomeController@index')->middleware("user.session");

Route::get('/login','App\Http\Controllers\HomeController@login');

Route::post('/login','App\Http\Controllers\HomeController@login_post');

Route::post('/youtube/search', 'App\Http\Controllers\YoutubeController@search')->middleware("user.session");

Route::get('/history/{id}', 'App\Http\Controllers\HistoryController@user')->middleware("user.session");

Route::get('/myhistory', 'App\Http\Controllers\HistoryController@index')->middleware("user.session");

Route::get('/users', 'App\Http\Controllers\UsersController@index')->middleware("user.session");

Route::get('/users/create', 'App\Http\Controllers\UsersController@create')->middleware("user.session");

Route::post('/users/store', 'App\Http\Controllers\UsersController@store')->middleware("user.session");

Route::get('/users/history/{id}', 'App\Http\Controllers\UsersController@history')->middleware("user.session");

Route::get('/users/edit/{id}', 'App\Http\Controllers\UsersController@edit')->middleware("user.session");

Route::post('/users/update', 'App\Http\Controllers\UsersController@update')->middleware("user.session");

Route::post('/users/delete', 'App\Http\Controllers\UsersController@delete')->middleware("user.session");

Route::get('/users/logout', 'App\Http\Controllers\UsersController@logout')->middleware("user.session");