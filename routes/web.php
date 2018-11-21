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
    return redirect()->route('login');
})->name('index');

Auth::routes(['verify' => true]);

Route::middleware('auth', 'verified')
    ->group( function(){

        Route::get('/home', 'TripController@index')->name('home');


        Route::get('/add-new-trip', 'TripController@create')->name('new-trip');
        Route::post('/add-new-trip/create', 'TripController@store')->name('create-trip');
        
        Route::get('/edit-trip/{trip}', 'TripController@edit')->name('edit-trip');
        Route::post('/update-trip/{trip}', 'TripController@update')->name('update-trip');

        Route::get('/show-trip/{trip}', 'TripController@show')->name('show-trip');

        Route::post('/delete-trip/{trip}', 'TripController@destroy')->name('delete-trip');


        Route::get('change-password', 'Auth\ChangePasswordController@showForm')->name('change-pass');
        Route::post('update-password', 'Auth\ChangePasswordController@update')->name('update-pass');

    });

