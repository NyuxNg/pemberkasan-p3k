<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="{{ config('app.name') }}" content="yes">
    <meta name="{{ config('app.name') }}" content="black">
    <meta content="{{ config('app.name') }} by Raden Parhanudin" name="description" />
    <meta content="Raden Parhanudin" name="author" />
    
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/dist/css/skins/_all-skins.min.css">
    {{-- Plugins --}}
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/template/adminlte/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte/plugins/sweetalert2/dist/sweetalert2.css') }}">
    @stack('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/dist/css/bs4.css">
    <link rel="stylesheet" href="{{ asset('public/template/adminlte') }}/dist/css/style.css">
    <base href="{{ url('/') }}">
</head>