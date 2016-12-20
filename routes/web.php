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

Route::get('/faker', function(){
  $faker = Faker::create();
  $faker->addProvider(new \Faker\Provider\id_ID\Person($faker));
  $faker->addProvider(new \Faker\Provider\id_ID\Address($faker));
  for ($i=0; $i < 100; $i++) {
      echo $faker->name;
  }
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

  Route::get('datakorban', function() {
    return View::make('admin.datakorban');
  });

  Route::get('datakecelakaan', 'AdminController@showLakalantas')->name('showLakalantas');

  Route::get('datakecelakaan/{id}', 'AdminController@showDetilLakalantas')->name('showDetilLakalantas');

  Route::post('datakecelakaan/{id}/postkorban', 'AdminController@postKorban')->name('postkorban');

  Route::get('peta', 'AdminController@showSebaran')->name('admin.sebaran');
});
