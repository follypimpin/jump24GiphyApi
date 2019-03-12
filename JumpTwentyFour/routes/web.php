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


Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'giphy_api'], function(){
    Route::get('/trending/{id}', 'Api\ApiGiphyController@getTrending');
    Route::post('/search', 'Api\ApiGiphyController@postSearch');
    Route::post('/random', 'Api\ApiGiphyController@postRandom');
    Route::post('/chunk_random', 'Api\ApiGiphyController@fetchSearchRandom');
    Route::post('/chunk_more_random', 'Api\ApiGiphyController@fetchSearchThouRandom');
    Route::get('/cursor_time_stamp/{id}', 'Api\ApiGiphyController@appendCursorTimeStamp');
    Route::get('/chunk_time_stamp/{id}', 'Api\ApiGiphyController@appendChunkTimeStap');
    Route::post('/search_cursor_latest', 'Api\ApiGiphyController@searchLatestCursor');
    Route::post('/search_chunk_latest', 'Api\ApiGiphyController@searchLatestNonCursor');
    Route::post('/search_paginated', 'Api\ApiGiphyController@searchPaginated');
    

});


