@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Berkas
        <small>Download</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Download :: Data Berkas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-body table-responsive">
                         @if (\Session::has('gagal'))
                            <p class="p-3 bg-navy text-white">
                                {!! \Session::get('gagal') !!}
                            </p>
                        @endif
                        <table class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $data = array(
                                        'download.berkas.surat-pernyataan.index' => 'Download Surat Pernyataan 5 Poin',
                                        'download.berkas.drh-perorangan.index' => 'Download Daftar Riwayat Hidup (DRH) - Perorangan',
                                        'download.berkas.drh-riwayat.index' => 'Download Daftar Riwayat Hidup (DRH) - Riwayat',
                                    );
                                @endphp
                                @foreach ($data as $key => $value)
                                <tr>
                                    <td class="text-nowrap align-middle">
                                        {{ $value }}
                                    </td>
                                    <td class="w-25 text-center text-nowrap align-middle">
                                        <a href="{{ route($key) }}" class="btn btn-sm bg-navy"><i class="fa fa-download mr-2">
                                            </i>Download
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
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
@push('script')
    <script>
        $(document).ready(function() {
            $('.btn-download').on('click', function(event) {
                event.preventDefault();
                var berkas = $('#berkas').val(),
                    base_url = $('base').attr('href') + '/download/berkas';

                if(berkas != ""){
                    if(berkas == "semua") {
                        window.location.href = base_url + "/all";
                    }
                    else{
                        window.location.href = base_url + "/peserta/" + berkas;
                    }
                }
                else{
                    alert('Pilih berkas terlebih dahulu')
                }
            });
        });
    </script>   
@endpush