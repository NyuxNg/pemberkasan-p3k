<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
	use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_pelatihan';
	protected $fillable  = ['id', 'peserta_id', 'nama_pelatihan', 'mulai', 'selesai', 'nomor', 'tempat', 'institusi_penyelenggara'];
}
