<?php
Route::group(['prefix' => 'getdata', 'middleware' => ['auth']], function() {
	Route::post('/roles', 'GetDataController@roles')->name('getdata.roles');
	Route::post('/peserta', 'GetDataController@peserta')->name('getdata.peserta');
	Route::post('/provinsi', 'GetDataController@provinsi')->name('getdata.provinsi');
	Route::post('/kabupaten', 'GetDataController@kabupaten')->name('getdata.kabupaten');
	Route::post('/kecamatan', 'GetDataController@kecamatan')->name('getdata.kecamatan');
	Route::post('/desa', 'GetDataController@desa')->name('getdata.desa');
});
