<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>Tingkat Pendidikan</label>
            <select name="tingkat" id="tingkat" class="form-control select2" data-placeholder="Tingkat" style="width: 100%">
                <option></option>
                @php
                    $data = array('SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D-I' => 'D-I', 'D-II' => 'D-II', 'D-III' => 'D-III', 'D-IV' => 'D-IV', 'S-1' => 'S-1', 'S-2' => 'S-2', 'S-3' => 'S-3', 'Prof' => 'Profesor', );
                @endphp
                @foreach ($data as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Nama Sekolah / Perguruan Tinggi</label>
            <input type="text" name="nama_lembaga" id="nama_lembaga" class="form-control" placeholder="Nama Sekolah / Perguruan Tinggi">
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Tempat</label>
            <select name="tempat_id" id="tempat_id" class="form-control select2" data-placeholder="Tempat" style="width:100%">
                <option></option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Nomor Ijazah</label>
            <input type="text" name="ijazah_nomor" id="ijazah_nomor" class="form-control" placeholder="Nomor Ijazah">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Tanggal Ijazah</label>
            <input type="text" name="ijazah_tanggal" id="ijazah_tanggal" class="form-control tanggal" placeholder="Tanggal Ijazah">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Pejabat Penanda Tangan</label>
            <input type="text" name="ijazah_pejabat" id="ijazah_pejabat" class="form-control" placeholder="Pejabat Penanda Tangan">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Akreditasi</label>
            <input type="text" name="akreditasi" id="akreditasi" class="form-control" placeholder="Akreditasi">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Gelar Depan</label>
            <input type="text" name="gelar_depan" id="gelar_depan" class="form-control" placeholder="Gelar Depan">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Gelar Belakang</label>
            <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control" placeholder="Gelar Belakang">
        </div>
    </div>
</div>