@hasrole('admin|peserta')
<li class="header">DAFTAR RIWAYAT HIDUP</li>
@hasrole('peserta')
@php
	$route = array(
		'drh.perorangan.index'  => 'Keterangan Perorangan', 
		'drh.pendidikan.index'  => 'Pendidikan', 
		'drh.pelatihan.index'   => 'Pelatihan', 
		'drh.pekerjaan.index'   => 'Pekerjaan', 
		'drh.penghargaan.index' => 'Penghargaan', 
		'drh.pasangan.index'    => 'Pasangan', 
		'drh.anak.index'        => 'Anak', 
		'drh.orang-tua.index'   => 'Orang Tua', 
		'drh.saudara.index'     => 'Saudara', 
		'drh.mertua.index'      => 'Mertua', 
		'drh.organisasi.index'  => 'Organisasi', 
		'drh.lainnya.index'     => 'Keterangan Lainnya', 
	);
@endphp
<li class="{{ set_active(array_keys($route)) }} treeview">
	<a href="#">
		<i class="fa fa-leanpub"></i> <span>Pengisian Data DRH</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
		@foreach ($route as $key => $value)
			<li class="{{ set_active($key) }}">
				<a href="{{ route($key) }}"><i class="fa fa-circle-o"></i>{{ $value }}</a>
			</li>
		@endforeach
	</ul>
</li>
@endhasrole
@endhasrole