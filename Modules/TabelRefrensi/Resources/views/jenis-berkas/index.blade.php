@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Jenis Berkas
        <small>Tabel Refrensi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tabel Refrensi :: Data Jenis Berkas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a href="{{ route('tabref.jenis-berkas.export') }}" class="btn btn-success"><i class="fa fa-download mr-2"></i>Export Data</a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalImport"><i class="fa fa-upload mr-2"></i>Import Data</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Kode</th>
                                    <th>Format</th>
                                    <th>Size (KB)</th>
                                    <th>Penamaan</th>
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
    'modalType'         => 'modalImport',
    'id'                => 'modalImport',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => '', 
    'title'             => 'Import Data Jenis Berkas',
    'body'              => view('component._import'),
    'formId'            => 'formImport', 
    'formClass'         => '', 
    'formAction'        => route('tabref.jenis-berkas.import'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('TabelRefrensi', 'js/jenis-berkas.js') }}"></script>
@endpush