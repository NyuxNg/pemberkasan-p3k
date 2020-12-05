@hasrole('admin')
<li class="header">USER MANAJEMEN</li>
<li class="{{ set_active('userman.panitia.index') }}">
    <a href="{{ route('userman.panitia.index') }}">
        <i class="fa fa-user-secret text-danger"></i> <span>User Panitia</span>
    </a>
</li>
<li class="{{ set_active('userman.peserta.index') }}">
    <a href="{{ route('userman.peserta.index') }}">
        <i class="fa fa-users text-info"></i> <span>User Peserta</span>
    </a>
</li>
@endhasrole