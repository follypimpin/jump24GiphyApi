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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'giphy_api'], function(){
    Route::get('/trending/{id}', 'Api\ApiGiphyController@getTrending');
    Route::post('/search', 'Api\ApiGiphyController@postSearch');
});


