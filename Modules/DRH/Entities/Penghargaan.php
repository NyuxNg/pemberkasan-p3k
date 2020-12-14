<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
	use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_penghargaan';
	protected $fillable  = ['id', 'peserta_id', 'nama', 'sk_nomor', 'sk_tanggal', 'tahun_perolehan', 'instansi_pemberi'];
}
