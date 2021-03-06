<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your addon. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('admin/user-list/{user}/sub', 'SubscriptionController@subscription')->name('user-list.sub');
Route::put('admin/user-list/{user}', 'SubscriptionController@extendSubcription');