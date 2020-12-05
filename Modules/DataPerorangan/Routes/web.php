<?php
Route::group(['prefix' => 'data', 'middleware' => ['auth', 'role:peserta']], function() {
	Route::get('/', function() {
	    return redirect()->route('data-perorangan.kontak.index');
	});
	
    Route::group(['prefix' => 'kontak'], function() {
    	Route::get('/', 'DataKontakController@index')->name('data-perorangan.kontak.index');
    	Route::post('/', 'DataKontakController@store')->name('data-perorangan.kontak.store');
    	Route::get('/show', 'DataKontakController@show')->name('data-perorangan.kontak.show');
    });

    Route::group(['prefix' => 'lainnya'], function() {
    	Route::get('/', 'DataLainnyaController@index')->name('data-perorangan.lainnya.index');
    	Route::post('/', 'DataLainnyaController@store')->name('data-perorangan.lainnya.store');
    	Route::get('/show', 'DataLainnyaController@show')->name('data-perorangan.lainnya.show');
    });
});
