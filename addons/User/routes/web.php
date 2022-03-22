<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your addon. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('my-account/edit', 'UserController@edit')->name('user.edit');
Route::patch('my-account/edit', 'UserController@update')->name('user.edit');
Route::post('my-account/update-password', 'UserController@updatePassword')->name('user.update_password');

// Login using Social Providers
Route::get('login/{provider}', 'OAuthController@redirect');
Route::get('login/{provider}/callback', 'OAuthController@callback');