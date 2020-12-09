@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Verifikasi Berkas
        <small>Laporan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Laporan :: Verifikasi Berkas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <div class="btn-group">
                            <a href="{{ route('laporan.verifikasi.download') }}" class="btn btn-success"><i class="fa fa-download mr-2"></i>Download</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="dataTableDefault" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Peserta</th>
                                    <th>Nama Peserta</th>
                                    <th>DRH</th>
                                    <th>SPCP</th>
                                    <th>FOTOP3K</th>
                                    <th>SKETSEHAT</th>
                                    <th>SKETNAPZA</th>
                                    <th>IJZPEND</th>
                                    <th>IJZNILAI</th>
                                    <th>SKCK</th>
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
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var dataTableDefault = $('#dataTableDefault').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: {
		            url: $('base').attr('href') + "/laporan/verifikasi/data"
		        },
		        columns: [
		            { data: 'DT_RowIndex', name: 'id', className: 'w-5 text-center align-middle' },
		            { data: 'no_peserta', name: 'no_peserta', className: 'text-center text-nowrap align-middle' },
		            { data: 'nama', name: 'nama', className: 'text-nowrap align-middle' },
		            { data: 'DRH', name: 'DRH', className: 'text-center text-nowrap align-middle' },
		            { data: 'SPCP', name: 'SPCP', className: 'text-center text-nowrap align-middle' },
		            { data: 'FOTOP3K', name: 'FOTOP3K', className: 'text-center text-nowrap align-middle' },
		            { data: 'SKETSEHAT', name: 'SKETSEHAT', className: 'text-center text-nowrap align-middle' },
		            { data: 'SKETNAPZA', name: 'SKETNAPZA', className: 'text-center text-nowrap align-middle' },
		            { data: 'IJZPEND', name: 'IJZPEND', className: 'text-center text-nowrap align-middle' },
		            { data: 'IJZNILAI', name: 'IJZNILAI', className: 'text-center text-nowrap align-middle' },
		            { data: 'SKCK', name: 'SKCK', className: 'text-center text-nowrap align-middle' },
		        ],	
		        "columnDefs": [
		            {
		                "render": function ( data, type, row ) {
		                    if(data == "Proses"){
		                    	return '<i class="fa fa-info-circle text-info"></i>';
		                    }
		                    else if(data == "Diterima"){
		                    	return '<i class="fa fa-check-circle text-success"></i>';
		                    }
		                    else if(data == "Ditolak"){
		                    	return '<i class="fa fa-close text-danger"></i>';
		                    }
		                    else{
		                    	return data;
		                    }

		                },
		                "targets": [3, 4, 5, 6, 7, 8, 9, 10]
		            },
		        ],
		        "initComplete": function(settings, json) {
		            $('#dataTableDefault_filter input').unbind();
		            $('#dataTableDefault_filter input').bind('keyup', function(e) {
		                if (this.value == "" || e.keyCode == 13) {
		                    $('#dataTableDefault').DataTable().search(this.value).draw();
		                }
		            });
		        },
		    });
        });
    </script>   
@endpush