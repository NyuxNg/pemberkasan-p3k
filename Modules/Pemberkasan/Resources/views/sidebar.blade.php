@hasrole('peserta|verifikator')
<li class="header">PEMBERKASAN</li>
@hasrole('peserta')
<li class="{{ set_active('berkas.upload.index') }}">
    <a href="{{ route('berkas.upload.index') }}">
        <i class="fa fa-upload text-info"></i> <span>Upload Berkas</span>
    </a>
</li>
@endhasrole
@hasrole('verifikator')
<li class="{{ set_active('berkas.verifikasi.index') }}">
    <a href="{{ route('berkas.verifikasi.index') }}">
        <i class="fa fa-check text-primary"></i> <span>Verifikasi Berkas</span>
    </a>
</li>
@endhasrole
@endhasrole