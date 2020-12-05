<?php
Route::group(['prefix' => 'getdata', 'middleware' => ['auth']], function() {
	Route::post('/roles', 'GetDataController@roles')->name('getdata.roles');
});
