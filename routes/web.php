<?php

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dokumentasi', function () {
    return redirect('https://drive.google.com/drive/folders/1RFqCQJ0Pcmcj2VWmub05LpaJOVhZLvkH?usp=sharing');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
