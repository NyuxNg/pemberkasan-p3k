<?php

Route::group(['prefix' => 'dashboard','middleware' => ['auth']], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});