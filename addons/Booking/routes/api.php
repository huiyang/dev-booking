<?php

Route::post('collection/{slug}/{entry}/book', 'BookingController@store');
Route::get('booking/{booking}', 'BookingController@show');
Route::post('booking/{booking}/detail', 'BookingDetailController@store');
Route::delete('booking/{booking}', 'BookingController@destroy');