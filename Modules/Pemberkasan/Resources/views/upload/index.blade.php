@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Upload Berkas
        <small>Pemberkasan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pemberkasan :: Upload Berkas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Nama Berkas</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-6 col-sm-offset-3 text-center">
                            <button class="btn btn-danger btn-lg btn-kirim-berkas"><i class="fa fa-telegram mr-2"></i>Kirim Berkas Sekarang</button>
                        </div>
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
    'modalType'         => 'modalUpload',
    'id'                => 'modalUpload',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => '', 
    'title'             => 'Upload Berkas',
    'body'              => view('component._import'),
    'formId'            => 'formUpload', 
    'formClass'         => '', 
    'formAction'        => '', 
    'formMethod'        => 'POST', 
])
@include('component._modal', [
    'modalType'         => 'modalBasic',
    'id'                => 'modalBasic',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => '', 
    'title'             => 'Status Berkas',
    'body'              => view('pemberkasan::upload.cek-status'),
])
@endsection
@push('script')
<script src="{{ modul_asset('Pemberkasan', 'js/upload-berkas.js') }}"></script>
@endpush