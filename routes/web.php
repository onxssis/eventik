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

Route::get('/', 'EventsController@index')->name('welcome');

Route::post('/events/{id}/bookmark', 'BookmarksController@store')
    ->name('bookmarks.store');

Route::delete('/events/{id}/bookmark', 'BookmarksController@destroy')
    ->name('bookmarks.destroy');

Route::post('/events/{slug}/reservations', 'ReservationController@store')
    ->name('events.attend')
    ->middleware('auth');

Route::delete('/events/{slug}/reservations', 'ReservationController@destroy')
    ->name('events.unattend')
    ->middleware('auth');

Route::resource('events', 'EventsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
