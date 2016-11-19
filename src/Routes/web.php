<?php

Route::group(['middleware' => 'web', 'as' => 'laralang::', 'prefix' => config('laralang.default.prefix'), 'namespace' => 'Aitor24\Laralang\Controllers'], function () {
    Route::get('/login', 'LaralangController@showLogin')->name('login');
    Route::post('/login', 'LaralangController@login');

    Route::group(['middleware' => 'laralang.middleware'], function () {
        Route::get('/', function () {
            return redirect(Route('laralang::translations'));
        })->name('home');
        Route::get('/translations', 'LaralangController@showTranslations')->name('translations');
        Route::get('/delete/{id}', 'LaralangController@deleteTrans')->name('delete');
        Route::get('/edit/{id}/{translation}', 'LaralangController@editTrans');
        Route::get('/logout', 'LaralangController@logout')->name('logout');
        Route::group(['middleware' => ['throttle:5000,1', 'bindings']], function () {
            Route::get('/api', 'LaralangController@api')->name('api');
        });
    });
});
