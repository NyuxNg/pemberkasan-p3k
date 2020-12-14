<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_pendidikan';
	protected $fillable  = ['id', 'peserta_id', 'tingkat', 'nama_lembaga', 'akreditasi', 'tempat_id', 'ijazah_nomor', 'ijazah_tanggal', 'ijazah_pejabat', 'gelar_depan', 'gelar_belakang'];

	public function kabupaten()
	{
		return $this->hasOne('Modules\TabelRefrensi\Entities\DataKabupaten', 'id', 'tempat_id');
	}
}
