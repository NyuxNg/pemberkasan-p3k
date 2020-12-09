@hasrole('admin|verifikator')
<li class="header">TABEL REFRENSI</li>
<li class="{{ set_active('tabref.peserta.index') }}">
    <a href="{{ route('tabref.peserta.index') }}">
        <i class="fa fa-users text-warning"></i> <span>Data Peserta</span>
    </a>
</li>
@hasrole('admin')
<li class="{{ set_active('tabref.kabupaten.index') }}">
    <a href="{{ route('tabref.kabupaten.index') }}">
        <i class="fa fa-globe text-success"></i> <span>Data Kabupaten</span>
    </a>
</li>
<li class="{{ set_active('tabref.jenis-berkas.index') }}">
    <a href="{{ route('tabref.jenis-berkas.index') }}">
        <i class="fa fa-database"></i> <span>Jenis Berkas</span>
    </a>
</li>
@endhasrole
@endhasrole