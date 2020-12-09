@hasrole('admin|verifikator')
<li class="header">LAPORAN</li>
<li class="{{ set_active('laporan.verifikasi.index') }}">
    <a href="{{ route('laporan.verifikasi.index') }}">
        <i class="fa fa-print text-blue"></i> <span>Hasil Verifikasi</span>
    </a>
</li>
@endhasrole