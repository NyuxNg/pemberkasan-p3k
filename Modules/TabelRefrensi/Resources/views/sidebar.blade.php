@hasrole('admin|verifikator')
<li class="header">TABEL REFRENSI</li>
@hasrole('admin')
<li class="{{ set_active(['tabref.provinsi.index', 'tabref.kabupaten.index', 'tabref.kecamatan.index', 'tabref.desa.index']) }} treeview">
	<a href="#">
		<i class="fa fa-globe"></i> <span>Data Wilayah</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		<li class="{{ set_active('tabref.provinsi.index') }}">
			<a href="{{ route('tabref.provinsi.index') }}"><i class="fa fa-circle-o text-danger"></i>Provinsi</a>
		</li>
		<li class="{{ set_active('tabref.kabupaten.index') }}">
			<a href="{{ route('tabref.kabupaten.index') }}"><i class="fa fa-circle-o text-yellow"></i>Kabupaten</a>
		</li>
		<li class="{{ set_active('tabref.kecamatan.index') }}">
			<a href="{{ route('tabref.kecamatan.index') }}"><i class="fa fa-circle-o text-success"></i>Kecamatan</a>
		</li>
		<li class="{{ set_active('tabref.desa.index') }}">
			<a href="{{ route('tabref.desa.index') }}"><i class="fa fa-circle-o text-primary"></i>Desa</a>
		</li>
	</ul>
</li>
<li class="{{ set_active('tabref.jenis-berkas.index') }}">
	<a href="{{ route('tabref.jenis-berkas.index') }}">
		<i class="fa fa-database"></i> <span>Jenis Berkas</span>
	</a>
</li>
@endhasrole
<li class="{{ set_active('tabref.peserta.index') }}">
	<a href="{{ route('tabref.peserta.index') }}">
		<i class="fa fa-users text-warning"></i> <span>Data Peserta</span>
	</a>
</li>
@endhasrole