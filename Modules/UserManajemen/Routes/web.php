<?php
Route::group(['prefix' => 'userman', 'middleware' => ['auth', 'role:admin']], function() {
	Route::get('/', function() {
	    return redirect()->route('userman.panitia.index');
	});
	
    Route::group(['prefix' => 'panitia'], function() {
    	Route::get('/', 'UserPanitaController@index')->name('userman.panitia.index');
    	Route::post('/', 'UserPanitaController@store')->name('userman.panitia.store');
    	Route::get('/{id}/edit', 'UserPanitaController@edit')->name('userman.panitia.edit');
    	Route::put('/{id}', 'UserPanitaController@update')->name('userman.panitia.update');
    	Route::delete('/destroy/{id}', 'UserPanitaController@destroy')->name('userman.panitia.destroy');
    	Route::get('/data', 'UserPanitaController@data')->name('userman.panitia.data');
    });

    Route::group(['prefix' => 'peserta'], function() {
        Route::get('/', 'UserPesertaController@index')->name('userman.peserta.index');
        Route::post('/', 'UserPesertaController@store')->name('userman.peserta.store');
        Route::get('/{id}/edit', 'UserPesertaController@edit')->name('userman.peserta.edit');
        Route::put('/{id}', 'UserPesertaController@update')->name('userman.peserta.update');
        Route::delete('/destroy/{id}', 'UserPesertaController@destroy')->name('userman.peserta.destroy');
        Route::get('/data', 'UserPesertaController@data')->name('userman.peserta.data');
    });
});
