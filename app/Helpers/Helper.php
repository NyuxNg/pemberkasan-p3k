<?php

use Carbon\Carbon;

if (! function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if( is_array($uri) ) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)){
                return $output;
            }
        }
    }
}

if (! function_exists('modul_asset')) {
    function modul_asset($modul_name, $path)
    {
        return url('/Modules') . "/" . $modul_name . "/public/" . $path;
    }
}

if (! function_exists('tanggal')) {
    function tanggal($tanggal)
    {
        $value = Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('d F Y');
    }
}

if (! function_exists('bulan')) {
    function bulan()
    {
        $value = Carbon::parse(date('Y-m-d'));
        $parse = $value->locale('id');
        return $parse->translatedFormat('F Y');
    }
}

if (! function_exists('dashbord_url')) {
    function dashbord_url()
    {
        return redirect()->route('dashboard.index');
    }
}

