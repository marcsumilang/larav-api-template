<?php

use Illuminate\Support\Facades\Route;


/**
 * User
 */
Route::group(["prefix" => "users"], function(){
    Route::get("/","UserController@get");
    Route::post("/","UserController@store");
    Route::get("/{id}","UserController@show");
    Route::put("/{id}","UserController@update");
    Route::delete("/{id}","UserController@delete");
});