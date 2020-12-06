<?php
Route::group(['prefix' => 'download', 'middleware' => ['auth', 'role:verifikator|admin']], function() {
	Route::get('/', function() {
	    return redirect()->route('download.data.index');
	});
	
    Route::group(['prefix' => 'data'], function() {
    	Route::get('/', 'DownloadDataController@index')->name('download.data.index');
    	Route::get('/peserta', 'DownloadDataController@peserta')->name('download.data.peserta');
    	Route::get('/kontak', 'DownloadDataController@kontak')->name('download.data.kontak');
    	Route::get('/lainnya', 'DownloadDataController@lainnya')->name('download.data.lainnya');
    });
    Route::group(['prefix' => 'berkas'], function() {
    	Route::get('/', 'DownloadBerkasController@index')->name('download.berkas.index');
    	Route::get('/all', 'DownloadBerkasController@all')->name('download.berkas.all');
    	Route::get('/peserta/{id}', 'DownloadBerkasController@peserta')->name('download.berkas.peserta');
    });
});
