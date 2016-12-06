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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'administrator'], function () {

  Route::get('/', function () {
    return redirect('administrator/dashboard');
  });

  Route::get('dashboard', function() {
    return View::make('admin.index');
  });

  Route::get('datakorban', function() {
    return View::make('admin.datakorban');
  });

  Route::get('peta', function() {
    return View::make('admin.map');
  });
});
