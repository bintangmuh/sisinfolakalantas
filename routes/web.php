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
use Faker\Factory as Faker;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'UserController@beranda');

  Route::get('/kompkendaraan', function() {
    return view('components.addkendaraan');
  });

  Route::get('/detail/{id}', 'KejadianController@show')->name('detailkejadian');

  Route::post('/addkejadian', 'UserController@addKejadian');

  Route::post('/search', 'UserController@search');
});


Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'administrator'], function () {

  Route::get('/', function () {
    return redirect('administrator/dashboard');
  });

  Route::get('dashboard', 'AdminController@showIndex');

  Route::get('datakorban', 'AdminController@showAllKorban');

  Route::get('datakecelakaan', 'AdminController@showLakalantas')->name('showLakalantas');

  Route::get('datakecelakaan/{id}', 'AdminController@showDetilLakalantas')->name('showDetilLakalantas');

  Route::post('datakecelakaan/{id}/postkorban', 'AdminController@postKorban')->name('postkorban');

  Route::post('tambahkendaraan/{id}/', 'AdminController@tambahKendaraan')->name('tambahkendaraan');

  Route::post('editkorban/{id}/', 'AdminController@editKorban')->name('editkorban');

  Route::get('hapuskorban/{id}/', 'AdminController@hapusKorban')->name('hapuskorban');

  Route::post('editkendaraan/{id}/', 'AdminController@editKendaraan')->name('editkendaraan');

  Route::get('peta', 'AdminController@showSebaran')->name('admin.sebaran');
});
