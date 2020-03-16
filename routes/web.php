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

Route::get('/helfen', 'NeedController@index')->name('need.index');
Route::get('/gesuch/{need}', 'NeedController@show')->name('need.show');
Route::post('/gesuch/{need}/kontaktieren', 'NeedController@contact')->name('need.contact');

Route::get('/gesuche', 'NeedController@list')->middleware('auth')->name('need.list');
Route::get('/gesuche/erstellen', 'NeedController@create')->middleware('auth')->name('need.create');
Route::post('/gesuche', 'NeedController@store')->middleware('auth')->name('need.store');
Route::patch('/gesuch/{need}', 'NeedController@update')->middleware('auth')->name('need.update');
Route::patch('/gesuch/{need}/toggle', 'NeedController@toggle')->middleware('auth')->name('need.toggle');
Route::get('/gesuch/{need}/bearbeiten', 'NeedController@edit')->middleware('auth')->name('need.edit');
Route::delete('/gesuch/{need}', 'NeedController@destroy')->middleware('auth')->name('need.delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/raw/needs', 'NeedController@rawIndex');
