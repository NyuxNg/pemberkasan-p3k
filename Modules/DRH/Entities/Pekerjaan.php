<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
	use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_pekerjaan';
	protected $fillable  = ['id', 'peserta_id', 'instansi', 'jabatan', 'mulai', 'selesai', 'gaji_pokok', 'sk_nomor', 'sk_tanggal', 'sk_pejabat_penandatangan'];
}
