<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'AdminController@dashboard');
    Route::resource('country', 'CountryController');
    Route::resource('state', 'StateController');
    Route::resource('city', 'CityController');

});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin', 'AdminController@index')->name('admin');

