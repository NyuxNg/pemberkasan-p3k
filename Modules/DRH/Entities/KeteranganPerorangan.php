<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class KeteranganPerorangan extends Model
{
    use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_keterangan_perorangan';
	protected $fillable  = ['id', 'peserta_id', 'nik', 'nama', 'tempat_lahir_id', 'tanggal_lahir', 'jk', 'agama', 'status_perkawinan', 'email', 'no_hp', 'provinsi_id', 'kabupaten_id', 'kecamatan_id', 'desa_id', 'jalan', 'tinggi_badan', 'berat_badan', 'rambut', 'bentuk_muka', 'warna_kulit', 'ciri_khas', 'cacat_tubuh', 'kegemaran'];

	public function provinsi()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataProvinsi', 'id', 'provinsi_id');
	}

	public function kabupaten()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKabupaten', 'id', 'kabupaten_id');
	}

	public function kecamatan()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKecamatan', 'id', 'kecamatan_id');
	}

	public function desa()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataDesa', 'id', 'desa_id');
	}

	public function tempat_lahir()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKabupaten', 'id', 'tempat_lahir_id');
	}
}
