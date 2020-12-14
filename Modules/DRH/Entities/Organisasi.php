<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
	use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_organisasi';
	protected $fillable  = ['id', 'peserta_id', 'nama', 'jabatan', 'mulai', 'selesai', 'tempat', 'pimpinan'];
}
