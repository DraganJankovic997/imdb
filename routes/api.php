<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::post('react', 'ReactionsController@react');

Route::get('/genres', 'GenreController@getAll');
Route::apiResource('movies', 'Api\MovieController');

Route::get('/comments/movies/{movie_id}', 'CommentController@getComments');
Route::post('/comments/movies/{movie_id}', 'CommentController@addComment');

Route::post('/watched/{id}', 'WatchListController@watched');

Route::get('/popular/movies', 'WatchListController@popular');
ROute::get('/related/movies/{genre_id}', 'WatchListController@related');