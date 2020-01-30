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

Route::prefix('admin/question-set')->middleware('admin')->group(function() {
    Route::get('/', 'QuestionSetController@index')->name('admin.questionsets');
    Route::get('create/{set?}', 'QuestionSetController@create')->name('admin.questionset.create');
    Route::post('store/{set?}', 'QuestionSetController@store')->name('admin.questionset.store');
    Route::get('delete/{set}', 'QuestionSetController@destroy')->name('admin.questionset.delete');
});
