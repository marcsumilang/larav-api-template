<?php

use Illuminate\Support\Facades\Route;


/**
 * Auth Routes
 */
Route::post('register','AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh/token', 'AuthController@refresh');
Route::post('account', 'AuthController@account');
Route::post('forgot/password','AuthController@forgot');
Route::post('reset/password','AuthController@reset');