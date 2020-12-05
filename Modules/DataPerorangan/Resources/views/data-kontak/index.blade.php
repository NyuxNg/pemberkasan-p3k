@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Kontak
        <small>Data Perorangan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Perorangan :: Data Kontak</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="box box-warning">
                    <div class="box-header text-center border-bottom bg-warning">
                        <h3 class="box-title font-weight-bold">Update Data Kontak</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if (\Session::has('success'))
                            <p class="p-3 bg-success text-white">
                                {!! \Session::get('success') !!}
                            </p>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('data-perorangan.kontak.store') }}">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">No. HP / Whatsapp</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="no_hp" value="{{ $kontak['no_hp'] }}" name="no_hp" placeholder="No. HP / Whatsapp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Alamat E-Mail</label>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $kontak['email'] }}" placeholder="Alamat E-Mail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Alamat Lengkap</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap">{{ $kontak['alamat'] }}</textarea>
                                        <small class="help-block text-danger font-italic">Ditulis dengan lengkap mulai dari wilayah dusun sampai dengan provinsi dan kode pos pada bagian akhir.</small>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning pull-right text-dark font-weight-bold"><i class="fa fa-refresh mr-3"></i>Update</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
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