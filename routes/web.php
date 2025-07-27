<?php

use Illuminate\Support\Facades\Route;

// User Routes
Route::namespace('User')->middleware('guest')->group( function () {
    Route::get('login', 'AuthController@showLogin')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('register', 'AuthController@showRegister')->name('register');
    Route::post('register', 'AuthController@register');
});

Route::get('logout', 'User\AuthController@logout')->name('logout')->middleware('auth');

Route::namespace('User')->middleware('auth')->group(function(){
    Route::get('/', 'PageController@home')->name('home');
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

    Route::resource('programming', 'ProgrammingController');
    Route::get('programming/datatable/ssd', 'ProgrammingController@ssd');

    Route::resource('tag', 'TagController');
    Route::get('tag/datatable/ssd', 'TagController@ssd');

    Route::resource('article', 'ArticleController');
    Route::get('article/datatable/ssd', 'ArticleController@ssd');
    Route::get('article/{id}/detail', 'ArticleController@detail')->name('admin.article.detail');

    Route::post('logout', 'AuthController@logout');
});
