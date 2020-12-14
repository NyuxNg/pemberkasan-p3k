@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Perorangan
            <small>Daftar Riwayat Hidup</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Perorangan</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header border-bottom bg-light">
                        <h3 class="box-title pt-3 text-maroon">Keterangan Perorangan</h3>
                        <div class="btn-group pull-right">
                            <button class="btn bg-maroon btn-update"><i class="fa fa-refresh mr-2"></i>Update Data</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-6 table-responsive mb-5">
                            <h4 class="text-maroon">Identitas Diri</h4>
                            <table class="table table-striped w-100">
                                @php
                                    $IdentitasDiri = array(
                                        'nik_result' => 'NIK', 'nama_result' => 'Nama', 'ttl_result' => 'TTL', 'jk_result' => 'JK', 'agama_result' => 'Agama', 'status_perkawinan_result' => 'Status Pern.',  'email_result' => 'EMail', 'no_hp_result' => 'No HP', 'kegemaran_result' => 'Kegemaran' 
                                    );
                                @endphp
                                @foreach ($IdentitasDiri as $key => $value)
                                    <tr>
                                        <td class="font-weight-bold w-25 text-nowrap">{{ $value }}</td>
                                        <td class="text-nowrap" width="2px">:</td>
                                        <td class="text-nowrap">{{ $perorangan[$key] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-6 table-responsive mb-5">
                            <h4 class="text-maroon">Alamat</h4>
                            <table class="table table-striped w-100">
                                @php
                                    $alamat = array(
                                        'provinsi_result' => 'Provinsi', 'kabupaten_result' => 'Kabupaten', 'kecamatan_result' => 'Kecamatan', 'desa_result' => 'Desa', 'jalan_result' => 'Jalan'
                                    );
                                @endphp
                                @foreach ($alamat as $key => $value)
                                    <tr>
                                        <td class="font-weight-bold w-25 text-nowrap">{{ $value }}</td>
                                        <td class="text-nowrap" width="2px">:</td>
                                        <td class="text-nowrap">{{ $perorangan[$key] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-6 table-responsive mb-5">
                            <h4 class="text-maroon">Keterangan Badan</h4>
                            <table class="table table-striped w-100">
                                @php
                                    $keteranganBadan = array(
                                        'tinggi_badan_result' => 'Tinggi Badan', 'berat_badan_result' => 'Berat Badan', 'rambut_result' => 'Rambut', 'bentuk_muka_result' => 'Bentuk Muka', 'warna_kulit_result' => 'Warna Kulit', 'ciri_khas_result' => 'Ciri Khas', 'cacat_tubuh_result' => 'Cacat Tubuh'
                                    );
                                @endphp
                                @foreach ($keteranganBadan as $key => $value)
                                    <tr>
                                        <td class="font-weight-bold w-25 text-nowrap">{{ $value }}</td>
                                        <td class="text-nowrap" width="2px">:</td>
                                        <td class="text-nowrap">{{ $perorangan[$key] }}</td>
                                    </tr>
                                @endforeach
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
@include('component._modal', [
    'modalType'         => 'modalFormBasic',
    'id'                => 'modalDefault',
    'modalClass'        => '',
    'backdrop'          => true,
    'modalDiaglogClass' => 'modal-lg', 
    'title'             => 'Keterangan Perorangan',
    'body'              => view('drh::perorangan.form'),
    'formId'            => 'formUpdate', 
    'formClass'         => '', 
    'formAction'        => route('drh.perorangan.store'), 
    'formMethod'        => 'POST', 
])
@endsection
@push('script')
<script src="{{ modul_asset('DRH', 'js/keterangan-perorangan.js') }}"></script>
@endpush