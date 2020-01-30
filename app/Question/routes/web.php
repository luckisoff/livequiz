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

Route::prefix('admin/question')->middleware('admin')->group(function() {
    Route::get('/', 'QuestionController@index')->name('admin.questions');
    Route::get('create/{question?}', 'QuestionController@create')->name('admin.question.create');
    Route::post('store/{question?}', 'QuestionController@store')->name('admin.question.store');
    Route::get('delete/{question}', 'QuestionController@destroy')->name('admin.question.delete');

    Route::get('upload', 'QuestionController@upload')->name('admin.question.upload');
    Route::post('upload', 'QuestionController@import')->name('admin.question.import');
    Route::get('questions', 'QuestionController@questionJson')->name('admin.question.questionjson');
});
