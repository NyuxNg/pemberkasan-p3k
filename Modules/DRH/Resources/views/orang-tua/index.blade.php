@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Orang Tua
        <small>Daftar Riwayat Hidup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Daftar Riwayat Hidup :: Data Orang Tua</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header border-bottom">
                        <div class="btn-grou">
                            <button class="btn btn-danger btn-add"><i class="fa fa-plus-circle mr-2"></i>Data Orang Tua</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Pekerjaan</th>
                                    <th>Status Hidup</th>
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
    'modalDiaglogClass' => 'modal-lg', 
    'title'             => 'Data Orang Tua',
    'body'              => view('drh::orang-tua.form'),
    'formId'            => 'formDefault', 
    'formClass'         => '', 
    'formAction'        => route('drh.orang-tua.store'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('DRH', 'js/orang-tua.js') }}"></script>
@endpush