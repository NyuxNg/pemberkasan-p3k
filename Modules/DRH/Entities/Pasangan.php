<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
	use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_pasangan';
    protected $fillable = ['id', 'peserta_id', 'nik', 'nip', 'nama', 'tempat_lahir_id', 'tanggal_lahir', 'pekerjaan', 'pekerjaan_tempat', 'status_pernikahan', 'akte_nikah_nomor', 'akte_nikah_tanggal', 'status_hidup'];

    public function kabupaten()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKabupaten', 'id', 'tempat_lahir_id');
	}
}
