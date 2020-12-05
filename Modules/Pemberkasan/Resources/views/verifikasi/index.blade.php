@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Verifikasi Berkas
        <small>Pemberkasan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pemberkasan :: Verifikasi Berkas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <form role="form" id="formSearch">
                            <div class="form-group">
                                <label>Nomor Peserta</label>
                                <input type="text" class="form-control" name="no_peserta" placeholder="Nomor Peserta">
                            </div>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search mr-2"></i>Tampilkan</button>
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-sm-8">
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Nama Berkas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
@include('component._modal', [
    'modalType'         => 'modalNotif',
    'id'                => 'modalNotif',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => '', 
    'title'             => 'Keterangan Berkas Tidak Valid',
    'body'              => view('pemberkasan::verifikasi.notif'),
])
@endsection
@push('script')
<script src="{{ modul_asset('Pemberkasan', 'js/verifikasi-berkas.js') }}"></script>
@endpush