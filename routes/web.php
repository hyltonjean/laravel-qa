<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'QuestionsController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('questions', 'QuestionsController')->except('show');
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::resource('questions.answers', 'AnswersController')->except(['index', 'create', 'show']);
Route::post('/answers/{answer}/accept', 'AcceptAnswersController')->name('answers.accept');

Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'VoteQuestionController');
Route::post('/answers/{answer}/vote', 'VoteAnswerController');
