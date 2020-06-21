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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('region')->middleware('auth')->group(function(){
    Route::get('/', 'RegionController@index');
    Route::get('/create', 'RegionController@create');
    Route::get('/edit/{id}', 'RegionController@edit');
    Route::get('/delete/{id}', 'RegionController@delete');

    Route::post('/submit', 'RegionController@submit');
    Route::post('/update', 'RegionController@update');
});
