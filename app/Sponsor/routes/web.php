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

Route::prefix('admin/sponsor')->middleware('admin')->group(function() {
    Route::get('/', 'SponsorController@index')->name('admin.sponsors');
    Route::get('create/{sponsor?}','SponsorController@create')->name('admin.sponsor.create');
    Route::post('store/{sponsor?}','SponsorController@store')->name('admin.sponsor.store');
    Route::get('delete/{sponsor}','SponsorController@destroy')->name('admin.sponsor.delete');
});
