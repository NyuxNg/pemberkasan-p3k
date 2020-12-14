@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Pendidikan
        <small>Daftar Riwayat Hidup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Daftar Riwayat Hidup :: Data Pendidikan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header border-bottom">
                        <div class="btn-group">
                            <button class="btn btn-danger btn-add"><i class="fa fa-plus-circle mr-2"></i>Data Pendidikan</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Tingkat</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Tempat</th>
                                    <th rowspan="2">Akreditasi</th>
                                    <th colspan="2" class="text-center">Gelar</th>
                                    <th colspan="3" class="text-center">Ijazah</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Depan</th>
                                    <th>Belakang</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Pejabat</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
@include('component._modal', [
    'modalType'         => 'modalFormBasic',
    'id'                => 'modalDefault',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => 'modal-lg', 
    'title'             => 'Data Pendidikan',
    'body'              => view('drh::pendidikan.form'),
    'formId'            => 'formDefault', 
    'formClass'         => '', 
    'formAction'        => route('drh.pendidikan.store'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('DRH', 'js/pendidikan.js') }}"></script>
@endpush