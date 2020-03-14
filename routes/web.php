<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/needs', 'NeedController@index')->name('need.index');
Route::post('/needs', 'NeedController@store')->name('need.store');
Route::get('/needs/create', 'NeedController@create')->name('need.create');
Route::get('/needs/{need}', 'NeedController@show')->name('need.show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/raw/needs', 'RawNeedController@index');
