<?php

namespace Modules\TabelRefrensi\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class DataPeserta extends Model
{
	use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_data_peserta';
	protected $fillable  = ['id', 'no_peserta', 'nama', 'kab_kota_id', 'tanggal_lahir', 'pendidikan', 'unit_penempatan', 'jabatan'];

	public function kabupaten()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKabupaten', 'id', 'kab_kota_id');
	}

	public function kontak()
	{
		return $this->hasOne('Modules\DataPerorangan\Entities\DataKontak', 'peserta_id', 'id');
	}
}
