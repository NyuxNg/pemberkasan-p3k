@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Peserta</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header text-center border-bottom bg-light">
                        <h3 class="box-title">Data Identitas Peserta</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-5 table-responsive">
                            <h4>Info Login</h4>
                            <table class="table table-striped w-100">
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Nama</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $login->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Username</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $login->username }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">EMail</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $login->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-7 table-responsive">
                            <h4>Data Peserta</h4>
                            <table class="table table-striped w-100">
                                <tr>
                                    <td class="font-weight-bold text-nowrap">No. Peserta</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $peserta->no_peserta }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Nama Peserta</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $peserta->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Pendidikan</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $peserta->pendidikan }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Unit Penempatan</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $peserta->unit_penempatan }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Jabatan</td>
                                    <td class="text-nowrap" width="2px">:</td>
                                    <td class="text-nowrap">{{ $peserta->jabatan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
@endsection