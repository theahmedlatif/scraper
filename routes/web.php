<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/scrape/{id}','ScrapingController@fireAction')->name('scrape');


    Route::get('/websites','WebsiteController@index')->name('websites.list');
    Route::get('/website/add','WebsiteController@create')->name('website.create');
    Route::post('/website/store','WebsiteController@store')->name('website.store');

    Route::get('/website/articles/{id}','ArticleController@show')->name('show.articles');
});


