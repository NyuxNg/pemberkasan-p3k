<?php
Route::group(['prefix' => 'laporan', 'middleware' => ['auth', 'role:verifikator|admin']], function() {
	Route::get('/', function() {
	    return redirect()->route('laporan.verifikasi.index');
	});
	
    Route::group(['prefix' => 'verifikasi'], function() {
    	Route::get('/', 'LaporanController@index')->name('laporan.verifikasi.index');
    	Route::get('/data', 'LaporanController@data')->name('laporan.verifikasi.data');
    	Route::get('/download', 'LaporanController@download')->name('laporan.verifikasi.download');
    });
});
