@hasrole('peserta')
<li class="header">DATA PERORANGAN</li>
<li class="{{ set_active('data-perorangan.kontak.index') }}">
    <a href="{{ route('data-perorangan.kontak.index') }}">
        <i class="fa fa-phone text-warning"></i> <span>Data Kontak</span>
    </a>
</li>
<li class="{{ set_active('data-perorangan.lainnya.index') }}">
    <a href="{{ route('data-perorangan.lainnya.index') }}">
        <i class="fa fa-database text-danger"></i> <span>Data Lainnya</span>
    </a>
</li>
@endhasrole