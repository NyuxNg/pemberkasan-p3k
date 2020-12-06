@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ganti Password
        <small>User Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">User Profile :: Ganti Password</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-7">
                <div class="box box-warning">
                    <form action="{{ route('gantipass.ganti') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            @error('password')
                            <p class="text-white bg-red py-3 px-2 text-center">{{ $message }}</p>
                            @enderror
                            @if (\Session::has('success'))
                            <p class="text-white bg-green py-3 px-2 text-center">
                                {!! \Session::get('success') !!}
                            </p>
                            @endif
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-exchange mr-2"></i>Ganti Password</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection