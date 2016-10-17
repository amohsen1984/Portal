<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::resource('agents', 'AgentController');

Route::get('new-property', 
  ['as' => 'property_form', 'uses' => 'AddPropertyController@create']);
Route::post('new-property', 
  ['as' => 'property_store', 'uses' => 'AddPropertyController@store']);

Route::get('properties-list', function(){
    return view ('pages.properties_list');
})->name('PropertiesList');