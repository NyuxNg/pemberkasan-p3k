<?php
Route::group(['prefix' => 'drh', 'middleware' => ['auth']], function() {
	Route::get('/', function() {
	    return redirect()->route('drh.peserta.index');
	});
	Route::group(['middleware' => 'role:peserta'], function() {
        Route::group(['prefix' => 'perorangan'], function() {
        	Route::get('/', 'KeteranganPeroranganController@index')->name('drh.perorangan.index');
        	Route::post('/', 'KeteranganPeroranganController@store')->name('drh.perorangan.store');
        	Route::get('/edit', 'KeteranganPeroranganController@edit')->name('drh.perorangan.edit');
        	Route::get('/data', 'KeteranganPeroranganController@data')->name('drh.perorangan.data');
        });

        Route::group(['prefix' => 'pendidikan'], function() {
            Route::get('/', 'PendidikanController@index')->name('drh.pendidikan.index');
            Route::post('/', 'PendidikanController@store')->name('drh.pendidikan.store');
            Route::get('/{id}/edit', 'PendidikanController@edit')->name('drh.pendidikan.edit');
            Route::put('/update/{id}', 'PendidikanController@update')->name('drh.pendidikan.update');
            Route::delete('/{id}', 'PendidikanController@destroy')->name('drh.pendidikan.destroy');
            Route::get('/data', 'PendidikanController@data')->name('drh.pendidikan.data');
        });

        Route::group(['prefix' => 'pelatihan'], function() {
            Route::get('/', 'PelatihanController@index')->name('drh.pelatihan.index');
            Route::post('/', 'PelatihanController@store')->name('drh.pelatihan.store');
            Route::get('/{id}/edit', 'PelatihanController@edit')->name('drh.pelatihan.edit');
            Route::put('/update/{id}', 'PelatihanController@update')->name('drh.pelatihan.update');
            Route::delete('/{id}', 'PelatihanController@destroy')->name('drh.pelatihan.destroy');
            Route::get('/data', 'PelatihanController@data')->name('drh.pelatihan.data');
        });

        Route::group(['prefix' => 'pekerjaan'], function() {
            Route::get('/', 'PekerjaanController@index')->name('drh.pekerjaan.index');
            Route::post('/', 'PekerjaanController@store')->name('drh.pekerjaan.store');
            Route::get('/{id}/edit', 'PekerjaanController@edit')->name('drh.pekerjaan.edit');
            Route::put('/update/{id}', 'PekerjaanController@update')->name('drh.pekerjaan.update');
            Route::delete('/{id}', 'PekerjaanController@destroy')->name('drh.pekerjaan.destroy');
            Route::get('/data', 'PekerjaanController@data')->name('drh.pekerjaan.data');
        });

        Route::group(['prefix' => 'penghargaan'], function() {
            Route::get('/', 'PenghargaanController@index')->name('drh.penghargaan.index');
            Route::post('/', 'PenghargaanController@store')->name('drh.penghargaan.store');
            Route::get('/{id}/edit', 'PenghargaanController@edit')->name('drh.penghargaan.edit');
            Route::put('/update/{id}', 'PenghargaanController@update')->name('drh.penghargaan.update');
            Route::delete('/{id}', 'PenghargaanController@destroy')->name('drh.penghargaan.destroy');
            Route::get('/data', 'PenghargaanController@data')->name('drh.penghargaan.data');
        });

        Route::group(['prefix' => 'pasangan'], function() {
            Route::get('/', 'PasanganController@index')->name('drh.pasangan.index');
            Route::post('/', 'PasanganController@store')->name('drh.pasangan.store');
            Route::get('/{id}/edit', 'PasanganController@edit')->name('drh.pasangan.edit');
            Route::put('/update/{id}', 'PasanganController@update')->name('drh.pasangan.update');
            Route::delete('/{id}', 'PasanganController@destroy')->name('drh.pasangan.destroy');
            Route::get('/data', 'PasanganController@data')->name('drh.pasangan.data');
        });

        Route::group(['prefix' => 'anak'], function() {
            Route::get('/', 'AnakController@index')->name('drh.anak.index');
            Route::post('/', 'AnakController@store')->name('drh.anak.store');
            Route::get('/{id}/edit', 'AnakController@edit')->name('drh.anak.edit');
            Route::put('/update/{id}', 'AnakController@update')->name('drh.anak.update');
            Route::delete('/{id}', 'AnakController@destroy')->name('drh.anak.destroy');
            Route::get('/data', 'AnakController@data')->name('drh.anak.data');
        });

        Route::group(['prefix' => 'orang-tua'], function() {
            Route::get('/', 'OrangTuaController@index')->name('drh.orang-tua.index');
            Route::post('/', 'OrangTuaController@store')->name('drh.orang-tua.store');
            Route::get('/{id}/edit', 'OrangTuaController@edit')->name('drh.orang-tua.edit');
            Route::put('/update/{id}', 'OrangTuaController@update')->name('drh.orang-tua.update');
            Route::delete('/{id}', 'OrangTuaController@destroy')->name('drh.orang-tua.destroy');
            Route::get('/data', 'OrangTuaController@data')->name('drh.orang-tua.data');
        });

        Route::group(['prefix' => 'saudara'], function() {
            Route::get('/', 'SaudaraController@index')->name('drh.saudara.index');
            Route::post('/', 'SaudaraController@store')->name('drh.saudara.store');
            Route::get('/{id}/edit', 'SaudaraController@edit')->name('drh.saudara.edit');
            Route::put('/update/{id}', 'SaudaraController@update')->name('drh.saudara.update');
            Route::delete('/{id}', 'SaudaraController@destroy')->name('drh.saudara.destroy');
            Route::get('/data', 'SaudaraController@data')->name('drh.saudara.data');
        });

        Route::group(['prefix' => 'mertua'], function() {
            Route::get('/', 'MertuaController@index')->name('drh.mertua.index');
            Route::post('/', 'MertuaController@store')->name('drh.mertua.store');
            Route::get('/{id}/edit', 'MertuaController@edit')->name('drh.mertua.edit');
            Route::put('/update/{id}', 'MertuaController@update')->name('drh.mertua.update');
            Route::delete('/{id}', 'MertuaController@destroy')->name('drh.mertua.destroy');
            Route::get('/data', 'MertuaController@data')->name('drh.mertua.data');
        });

        Route::group(['prefix' => 'organisasi'], function() {
            Route::get('/', 'OrganisasiController@index')->name('drh.organisasi.index');
            Route::post('/', 'OrganisasiController@store')->name('drh.organisasi.store');
            Route::get('/{id}/edit', 'OrganisasiController@edit')->name('drh.organisasi.edit');
            Route::put('/update/{id}', 'OrganisasiController@update')->name('drh.organisasi.update');
            Route::delete('/{id}', 'OrganisasiController@destroy')->name('drh.organisasi.destroy');
            Route::get('/data', 'OrganisasiController@data')->name('drh.organisasi.data');
        });

        Route::group(['prefix' => 'lainnya'], function() {
            Route::get('/', 'KeteranganLainnyaController@index')->name('drh.lainnya.index');
            Route::post('/', 'KeteranganLainnyaController@store')->name('drh.lainnya.store');
            Route::get('/{id}/edit', 'KeteranganLainnyaController@edit')->name('drh.lainnya.edit');
            Route::put('/update/{id}', 'KeteranganLainnyaController@update')->name('drh.lainnya.update');
            Route::delete('/{id}', 'KeteranganLainnyaController@destroy')->name('drh.lainnya.destroy');
            Route::get('/data', 'KeteranganLainnyaController@data')->name('drh.lainnya.data');
        });
    });


});