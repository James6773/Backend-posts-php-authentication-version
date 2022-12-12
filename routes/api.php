<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

//Route::get('welcome', [CategoryController::class, 'apiWelcome']);
//Route::get('accessToken/get/{user_id}', 'App\Http\Controllers\AccessTokenController@getJWT');


Route::get('category/list', 'App\Http\Controllers\CategoryController@list');
Route::post('category/store', 'App\Http\Controllers\CategoryController@store');
Route::put('category/update/{id}', 'App\Http\Controllers\CategoryController@update');
Route::delete('category/destroy/{id}', 'App\Http\Controllers\CategoryController@destroy');
Route::get('category/listById/{id}', 'App\Http\Controllers\CategoryController@listById');

Route::get('post/list', 'App\Http\Controllers\PostController@list');
Route::post('post/store', 'App\Http\Controllers\PostController@store');
Route::put('post/update/{id}', 'App\Http\Controllers\PostController@update');
Route::delete('post/destroy/{id}', 'App\Http\Controllers\PostController@destroy');
Route::get('post/listById/{id}', 'App\Http\Controllers\PostController@listById');

Route::get('user/list', 'App\Http\Controllers\UserController@list');
Route::post('user/store', 'App\Http\Controllers\UserController@store');
Route::put('user/update/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('user/destroy/{id}', 'App\Http\Controllers\UserController@destroy');
Route::get('user/listById/{id}', 'App\Http\Controllers\UserController@listById');

Route::get('login/auth', 'App\Http\Controllers\AuthController@authentication');






