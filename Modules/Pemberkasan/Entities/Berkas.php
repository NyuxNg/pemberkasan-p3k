<?php

namespace Modules\Pemberkasan\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'pemberkasan_berkas';
	protected $fillable  = ['id', 'peserta_id', 'jberkas_id', 'file', 'status', 'keterangan', 'verifikator_id'];
}
