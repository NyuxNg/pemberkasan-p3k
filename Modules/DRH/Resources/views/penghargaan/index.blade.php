@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Penghargaan
        <small>Daftar Riwayat Hidup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Daftar Riwayat Hidup :: Data Penghargaan</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header border-bottom">
                        <div class="btn-grou">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalDefault"><i class="fa fa-plus-circle mr-2"></i>Data Penghargaan</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. SK</th>
                                    <th>Tanggal SK</th>
                                    <th>Tahun</th>
                                    <th>Instansi</th>
                                    <th>Action</th>
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
    'modalDiaglogClass' => '', 
    'title'             => 'Data Penghargaan',
    'body'              => view('drh::penghargaan.form'),
    'formId'            => 'formDefault', 
    'formClass'         => '', 
    'formAction'        => route('drh.penghargaan.store'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('DRH', 'js/penghargaan.js') }}"></script>
@endpush