<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

  Route::get('/', function () {
    return view('url');
}); 
Route::resource('urls','UrlController');
Route::get('urls/store', function() {
  return View::make('store');
});
Route::post('urls/store', 'UrlController@url');
Route::get('/{shortcode}', array('uses' => 'UrlController@handleShortcode', 'as' => 'handleShortcode'));