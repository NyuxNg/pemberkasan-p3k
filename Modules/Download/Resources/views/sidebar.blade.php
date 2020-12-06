@hasrole('admin|verifikator')
<li class="header">DOWNLOAD</li>
<li class="{{ set_active('download.data.index') }}">
    <a href="{{ route('download.data.index') }}">
        <i class="fa fa-users text-orange"></i> <span>Data Peserta</span>
    </a>
</li>
<li class="{{ set_active('download.berkas.index') }}">
    <a href="{{ route('download.berkas.index') }}">
        <i class="fa fa-book text-white"></i> <span>Berkas Peserta</span>
    </a>
</li>
@endhasrole