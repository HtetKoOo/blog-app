<?php

use Illuminate\Support\Facades\Route;

// Web Routes
Route::prefix('admin')->namespace('Admin')->middleware('guest:admin')->group( function () {
    Route::get('login', 'AuthController@showLogin')->name('admin.login.form');
    Route::post('login', 'AuthController@login')->name('admin.login');
});


//admin routes
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
