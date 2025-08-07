<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function(){
    return view('test');
});

// User Routes
Route::namespace('User')->middleware('guest')->group( function () {
    Route::get('login', 'AuthController@showLogin')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('register', 'AuthController@showRegister')->name('register');
    Route::post('register', 'AuthController@register');
});

Route::get('article','User\ArticleController@all')->name('article.all');
Route::get('article/{id}','User\ArticleController@detail')->name('article.detail');

Route::get('logout', 'User\AuthController@logout')->name('logout')->middleware('auth');


Route::namespace('User')->middleware('auth')->group(function(){
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/profile', 'ProfileController@showProfile')->name('showProfile');
});

//api
Route::prefix('api')->namespace('Api')->group(function(){
    Route::post('/article-comment', 'ArticleApi@makeComment');
    Route::post('/article-like', 'ArticleApi@like');
    Route::post('/article-save', 'ArticleApi@save');
    Route::get('/article-save', 'ArticleApi@getSave');
});


//_____________________________________________________________________________________________
//_____________________________________________________________________________________________


//Admin routes
Route::prefix('admin')->namespace('Admin')->middleware('guest:admin')->group( function () {
    Route::get('login', 'AuthController@showLogin')->name('admin.login.form');
    Route::post('login', 'AuthController@login')->name('admin.login');
});

Route::prefix('admin')->namespace('Admin')->middleware('auth:admin')->group( function () {

    Route::get('/', 'PageController@dashboard')->name('admin');

    Route::resource('article', 'ArticleController');
    Route::get('article/datatable/ssd', 'ArticleController@ssd');
    Route::get('article/{id}/detail', 'ArticleController@detail')->name('admin.article.detail');
    
    Route::resource('programming', 'ProgrammingController');
    Route::get('programming/datatable/ssd', 'ProgrammingController@ssd');
    
    Route::resource('tag', 'TagController');
    Route::get('tag/datatable/ssd', 'TagController@ssd');
    
    Route::resource('ads', 'AdsController');
    Route::get('ads/datatable/ssd', 'AdsController@ssd');
    Route::get('ads/{id}/detail', 'AdsController@detail')->name('admin.ads.detail');

    Route::post('logout', 'AuthController@logout');
});
