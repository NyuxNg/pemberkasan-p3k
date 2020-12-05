@extends('template.backend')
@section('content-wrapper')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Data Lainnya
        <small>Data Perorangan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Perorangan :: Data Lainnya</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header text-center border-bottom bg-danger">
                        <h3 class="box-title font-weight-bold text-white">Update Data Lainnya</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if (\Session::has('success'))
                        <p class="p-3 bg-success text-white">
                            {!! \Session::get('success') !!}
                        </p>
                        @endif
                        <form role="form" action="{{ route('data-perorangan.lainnya.store') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <h4 class="font-weight-bold text-danger">Keterangan</h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Jenis Kelamin <sup class="text-danger">*</sup></label>
                                            <select name="jk" id="jk" class="form-control select2" style="width:100%" data-placeholder="Jenis Kelamin" required>
                                                <option></option>
                                                <option value="L" {{ ($lainnya['jk'] == 'L') ? "selected" : ""  }}>Laki-laki</option>
                                                <option value="P" {{ ($lainnya['jk'] == 'P') ? "selected" : ""  }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Agama <sup class="text-danger">*</sup></label>
                                            <select name="agama" id="agama" class="form-control select2" style="width:100%" data-placeholder="Agama" required>
                                                <option></option>
                                                <option value="Islam" {{ ($lainnya['agama'] == 'Islam') ? "selected" : ""  }}>Islam</option>
                                                <option value="Hindu" {{ ($lainnya['agama'] == 'Hindu') ? "selected" : ""  }}>Hindu</option>
                                                <option value="Budha" {{ ($lainnya['agama'] == 'Budha') ? "selected" : ""  }}>Budha</option>
                                                <option value="Kristen" {{ ($lainnya['agama'] == 'Kristen') ? "selected" : ""  }}>Kristen</option>
                                                <option value="Katholik" {{ ($lainnya['agama'] == 'Katholik') ? "selected" : ""  }}>Katholik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Status Perkawinan <sup class="text-danger">*</sup></label>
                                            <select name="status_perkawinan" id="status_perkawinan" class="form-control select2" style="width:100%" data-placeholder="Status Perkawinan" required>
                                                <option></option>
                                                <option value="Belum Kawin" {{ ($lainnya['status_perkawinan'] == 'Belum Kawin') ? "selected" : ""  }}>Belum Kawin</option>
                                                <option value="Kawin" {{ ($lainnya['status_perkawinan'] == 'Kawin') ? "selected" : ""  }}>Kawin</option>
                                                <option value="Janda / Duda" {{ ($lainnya['status_perkawinan'] == 'Janda / Duda') ? "selected" : ""  }}>Janda / Duda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold mt-5 text-danger">Ijazah</h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nomor Ijazah <sup class="text-danger">*</sup></label>
                                            <input type="text" name="ijazah_nomor" id="ijazah_nomor" value="{{ $lainnya['ijazah_nomor'] }}" class="form-control" placeholder="Nomor Ijazah" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal Ijazah <sup class="text-danger">*</sup></label>
                                            <input type="text" name="ijazah_tanggal" id="ijazah_tanggal" value="{{ $lainnya['ijazah_tanggal'] }}" class="form-control tanggal" placeholder="Tanggal Ijazah" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Prodi / Perguruan Tinggi <sup class="text-danger">*</sup></label>
                                            <input type="text" name="ijazah_prodi" id="ijazah_prodi" value="{{ $lainnya['ijazah_prodi'] }}" class="form-control" placeholder="Prodi / Perguruan Tinggi" required>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold mt-5 text-danger">Surat Keterangan Catatan Kepolisian ( SKCK )</h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nomor SKCK <sup class="text-danger">*</sup></label>
                                            <input type="text" name="skck_nomor" id="skck_nomor" value="{{ $lainnya['skck_nomor'] }}" class="form-control" placeholder="Nomor SKCK" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal SKCK <sup class="text-danger">*</sup></label>
                                            <input type="text" name="skck_tanggal" id="skck_tanggal" value="{{ $lainnya['skck_tanggal'] }}" class="form-control tanggal" placeholder="Tanggal SKCK" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Pejabat <sup class="text-danger">*</sup></label>
                                            <input type="text" name="skck_pejabat" id="skck_pejabat" value="{{ $lainnya['skck_pejabat'] }}" class="form-control" placeholder="Pejabat" required>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold mt-5 text-danger">Surat Keterangan Sehat Jasmani dan Rohani </h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nomor <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_sehat_nomor" id="suket_sehat_nomor" value="{{ $lainnya['suket_sehat_nomor'] }}" class="form-control" placeholder="Nomor" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_sehat_tanggal" id="suket_sehat_tanggal" value="{{ $lainnya['suket_sehat_tanggal'] }}" class="form-control tanggal" placeholder="Tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Pejabat <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_sehat_pejabat" id="suket_sehat_pejabat" value="{{ $lainnya['suket_sehat_pejabat'] }}" class="form-control" placeholder="Pejabat" required>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold mt-5 text-danger">Surat Keterangan Bebas Narkoba </h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nomor <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_napza_nomor" id="suket_napza_nomor" value="{{ $lainnya['suket_napza_nomor'] }}" class="form-control" placeholder="Nomor" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tanggal <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_napza_tanggal" id="suket_napza_tanggal" value="{{ $lainnya['suket_napza_tanggal'] }}" class="form-control tanggal" placeholder="Tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Pejabat <sup class="text-danger">*</sup></label>
                                            <input type="text" name="suket_napza_pejabat" id="suket_napza_pejabat" value="{{ $lainnya['suket_napza_pejabat'] }}" class="form-control" placeholder="Pejabat" required>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="font-weight-bold mt-5 text-danger">Keterangan Lainnya</h4>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="keterangan_lainnya" id="keterangan_lainnya" class="form-control" placeholder="Keterangan Lainnya">{{ $lainnya['keterangan_lainnya'] }}</textarea> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-0">
                                    <div class="col-lg-12">
                                        <p class="bg-info py-3 text-white text-center">Inputan dengan tanda <span class="text-danger">*</span> wajib diisi</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-refresh mr-3"></i>Update</button>
                            </div>
                        </form>
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