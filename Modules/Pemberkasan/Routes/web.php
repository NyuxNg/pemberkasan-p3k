<?php
Route::group(['prefix' => 'berkas', 'middleware' => ['auth']], function() {
	Route::get('/', function() {
	    return redirect()->route('berkas.kontak.index');
	});
	
    Route::group(['prefix' => 'upload', 'middleware' => ['role:peserta']], function() {
    	Route::get('/', 'UploadBerkasController@index')->name('berkas.upload.index');
    	Route::post('/upload/{id}', 'UploadBerkasController@upload')->name('berkas.upload.upload');
    	Route::post('/cekstatus/{id}', 'UploadBerkasController@cekstatus')->name('berkas.upload.cekstatus');
    	Route::post('/kirim', 'UploadBerkasController@kirim')->name('berkas.upload.kirim');
    	Route::get('/data', 'UploadBerkasController@data')->name('berkas.upload.data');
    });

    Route::group(['prefix' => 'verifikasi', 'middleware' => ['role:verifikator']], function() {
        Route::get('/', 'VerifikasiBerkasController@index')->name('berkas.verifikasi.index');
        Route::post('/proses/{id}', 'VerifikasiBerkasController@proses')->name('berkas.verifikasi.proses');
        Route::get('/data', 'VerifikasiBerkasController@data')->name('berkas.verifikasi.data');
    });
});
