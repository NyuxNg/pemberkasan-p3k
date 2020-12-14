<?php

namespace Modules\DRH\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class KeteranganLainnya extends Model
{
    use Uuid;
	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'drh_keterangan_lainnya';
	protected $fillable  = ['id', 'peserta_id', 'nama', 'nomor', 'tanggal', 'pejabat'];

}