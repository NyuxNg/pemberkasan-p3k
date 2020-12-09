<?php
Route::group(['prefix' => 'tabref', 'middleware' => ['auth']], function() {
	Route::get('/', function() {
	    return redirect()->route('tabref.peserta.index');
	});
	Route::group(['middleware' => 'role:admin|verifikator'], function() {
        Route::group(['prefix' => 'data-peserta'], function() {
        	Route::get('/', 'DataPesertaController@index')->name('tabref.peserta.index');
        	Route::get('/export', 'DataPesertaController@export')->name('tabref.peserta.export');
        	Route::post('/import', 'DataPesertaController@import')->name('tabref.peserta.import');
        	Route::get('/data', 'DataPesertaController@data')->name('tabref.peserta.data');

        });
    });

    Route::group(['middleware' => 'role:admin'], function() {
        Route::group(['prefix' => 'data-kabupaten'], function() {
        	Route::get('/', 'DataKabupatenController@index')->name('tabref.kabupaten.index');
        	Route::get('/export', 'DataKabupatenController@export')->name('tabref.kabupaten.export');
        	Route::post('/import', 'DataKabupatenController@import')->name('tabref.kabupaten.import');
        	Route::get('/data', 'DataKabupatenController@data')->name('tabref.kabupaten.data');
        });

        Route::group(['prefix' => 'jenis-berkas'], function() {
            Route::get('/', 'JenisBerkasController@index')->name('tabref.jenis-berkas.index');
            Route::get('/export', 'JenisBerkasController@export')->name('tabref.jenis-berkas.export');
            Route::post('/import', 'JenisBerkasController@import')->name('tabref.jenis-berkas.import');
            Route::get('/data', 'JenisBerkasController@data')->name('tabref.jenis-berkas.data');
        });
    });

});


