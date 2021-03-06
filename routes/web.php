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

Route::get('/', 'QuestionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('questions', 'QuestionController')->except('show');
Route::get('/questions/{slug}', 'QuestionController@show')->name('questions.show');
//Route::post('/questions/{question}/answers', 'AnswerController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswerController')->only(['index', 'store', 'edit', 'update', 'destroy']); // nested routes

Route::post('/questions/{question}/favorite', 'FavoriteController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorite', 'FavoriteController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController')->name('questions.vote');
Route::post('/answers/{answer}/vote', 'VoteAnswerController')->name('answers.vote');

Route::post('/answers/{answer}/accept', 'AnswerAcceptController')->name('answers.accept');
