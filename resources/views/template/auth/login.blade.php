@extends('template.auth') @section('auth-content')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo mb-3">
            <a href="{{ url('/') }}" class="text-info font-weight-bold">Login <strong>P3K</strong></a>
        </div>
        <h4 class="text-center text-uppercase mt-0 mb-4">{{ config('app.instansi') }}</h4>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg text-danger">Masuk untuk memulai sesi Anda</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group @error('email') has-error @enderror">
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Username atau Email" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span> 
                    @error('email')
                        <span class="help-block">
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span> 
                    @error('password')
                        <span class="help-block">
                            {{ $message }}
                        </span> 
                    @enderror
                </div>
                <div class="row">
                    <div class="col-xs-8">
                       <!--  <div class="checkbox icheck">
                            <label>
                        <input type="checkbox"> Ingatkan saya
                        </label>
                        </div> -->
            <a href="https://drive.google.com/drive/folders/1RFqCQJ0Pcmcj2VWmub05LpaJOVhZLvkH?usp=sharing" class="btn bg-navy" target="_blank"><i class="fa fa-book mr-2"></i>Panudan</a><br>

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary pull-right font-weight-bold text-uppercase">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</body>
@endsection