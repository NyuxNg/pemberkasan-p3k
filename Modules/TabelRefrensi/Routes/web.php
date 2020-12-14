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
        Route::group(['prefix' => 'data-provinsi'], function() {
            Route::get('/', 'DataProvinsiController@index')->name('tabref.provinsi.index');
            Route::get('/export', 'DataProvinsiController@export')->name('tabref.provinsi.export');
            Route::post('/import', 'DataProvinsiController@import')->name('tabref.provinsi.import');
            Route::get('/data', 'DataProvinsiController@data')->name('tabref.provinsi.data');
        });

        Route::group(['prefix' => 'data-kabupaten'], function() {
        	Route::get('/', 'DataKabupatenController@index')->name('tabref.kabupaten.index');
        	Route::get('/export', 'DataKabupatenController@export')->name('tabref.kabupaten.export');
        	Route::post('/import', 'DataKabupatenController@import')->name('tabref.kabupaten.import');
        	Route::get('/data', 'DataKabupatenController@data')->name('tabref.kabupaten.data');
        });

        Route::group(['prefix' => 'data-kecamatan'], function() {
            Route::get('/', 'DataKecamatanController@index')->name('tabref.kecamatan.index');
            Route::get('/export', 'DataKecamatanController@export')->name('tabref.kecamatan.export');
            Route::post('/import', 'DataKecamatanController@import')->name('tabref.kecamatan.import');
            Route::get('/data', 'DataKecamatanController@data')->name('tabref.kecamatan.data');
        });

        Route::group(['prefix' => 'data-desa'], function() {
            Route::get('/', 'DataDesaController@index')->name('tabref.desa.index');
            Route::get('/export', 'DataDesaController@export')->name('tabref.desa.export');
            Route::post('/import', 'DataDesaController@import')->name('tabref.desa.import');
            Route::get('/data', 'DataDesaController@data')->name('tabref.desa.data');
        });

        Route::group(['prefix' => 'jenis-berkas'], function() {
            Route::get('/', 'JenisBerkasController@index')->name('tabref.jenis-berkas.index');
            Route::get('/export', 'JenisBerkasController@export')->name('tabref.jenis-berkas.export');
            Route::post('/import', 'JenisBerkasController@import')->name('tabref.jenis-berkas.import');
            Route::get('/data', 'JenisBerkasController@data')->name('tabref.jenis-berkas.data');
        });
    });

});


