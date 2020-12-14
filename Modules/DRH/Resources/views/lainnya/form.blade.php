<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Nama Keterangan</label>
            <select name="nama" id="nama" class="form-control select2" data-placeholder="Nama Keterangan" style="width: 100%">
                @php
                    $nama = array(
                        'a. skck'       => 'Surat Keterangan Catatan Kepolisian', 
                        'b. sks_jasroh' => 'Surat Keterangan Sehat Jasmani dan Rohani', 
                        'c. skb_napza'  => 'Surat Keterangan Bebas NAPZA', 
                        'd. lainnya'    => 'Keterangan Lainnya', 
                    );
                @endphp
                <option></option>
                @foreach ($nama as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Nomor</label>
            <input type="text" name="nomor" id="nomor" class="form-control" placeholder="Nomor">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Tanggal</label>
            <input type="text" name="tanggal" id="tanggal" class="form-control tanggal" placeholder="Tanggal">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Pejabat</label>
            <input type="text" name="pejabat" id="pejabat" class="form-control" placeholder="Pejabat">
        </div>
    </div>
</div>