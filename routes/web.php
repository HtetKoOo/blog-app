<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return redirect()->route('admin');
});

// Web Routes
Route::get('admin/login', 'Admin\AuthController@showLogin');
Route::post('admin/login', 'Admin\AuthController@login')->name('admin.login');

//admin routes
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'RedirectIfNotAdmin'],function(){
    Route::get('/','PageController@dashboard')->name('admin');

    Route::resource('programming', 'ProgrammingController');
    Route::get('programming/datatable/ssd', 'ProgrammingController@ssd');

    Route::resource('tag', 'TagController');
    Route::get('tag/datatable/ssd', 'TagController@ssd');

    Route::resource('article', 'ArticleController');

    Route::post('logout', 'AuthController@logout');
});

