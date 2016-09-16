<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */



Route::get('{object}/{id}', 'ApiController@GetObject');

Route::get('{object}', 'ApiController@GetList');

Route::post('{object}/{id}', 'ApiController@UpdateObject');

Route::post('{object}', 'ApiController@AddObject');

Route::delete('{object}/{id}', 'ApiController@DelObject');