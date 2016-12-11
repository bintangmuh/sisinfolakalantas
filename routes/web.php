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

Route::get('/home', 'HomeController@index');

Route::get('/homebeta', 'UserController@beranda');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'administrator'], function () {

  Route::get('/', function () {
    return redirect('administrator/dashboard');
  });

  Route::get('dashboard', 'AdminController@showIndex');

  Route::get('datakorban', function() {
    return View::make('admin.datakorban');
  });

  Route::get('peta', function() {
    return View::make('admin.map');
  });
});
