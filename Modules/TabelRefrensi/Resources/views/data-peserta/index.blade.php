@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Peserta
        <small>Tabel Refrensi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tabel Refrensi :: Data Peserta</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        @hasrole('admin')
                        <div class="btn-group">
                            <a href="{{ route('tabref.peserta.export') }}" class="btn btn-success"><i class="fa fa-download mr-2"></i>Export Data</a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalImport"><i class="fa fa-upload mr-2"></i>Import Data</button>
                        </div>
                        @endhasrole
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Peserta</th>
                                    <th>Nama Peserta</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Pendidikan</th>
                                    <th>Unit Penempatan</th>
                                    <th>Jabatan</th>
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
    'title'             => 'Import Data Peserta',
    'body'              => view('component._import'),
    'formId'            => 'formImport', 
    'formClass'         => '', 
    'formAction'        => route('tabref.peserta.import'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('TabelRefrensi', 'js/data-peserta.js') }}"></script>
@endpush