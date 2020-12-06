@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Peserta
        <small>Download</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Download :: Data Peserta</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap align-middle">Download <strong class="font-italic">Data Peserta</strong></td>
                                    <td class="w-25 text-center text-nowrap align-middle"><a href="{{ route('download.data.peserta') }}" class="btn btn-sm bg-navy" target="_blank"><i class="fa fa-download mr-2"></i>Download</a></td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap align-middle">Download <strong class="font-italic">Data Kontak</strong></td>
                                    <td class="w-25 text-center text-nowrap align-middle"><a href="{{ route('download.data.kontak') }}" class="btn btn-sm bg-navy" target="_blank"><i class="fa fa-download mr-2"></i>Download</a></td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap align-middle">Download <strong class="font-italic">Data Lainnya</strong></td>
                                    <td class="w-25 text-center text-nowrap align-middle"><a href="{{ route('download.data.lainnya') }}" class="btn btn-sm bg-navy" target="_blank"><i class="fa fa-download mr-2"></i>Download</a></td>
                                </tr>
                            </tbody>
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
@endsection