<?php

namespace Modules\TabelRefrensi\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class JenisBerkas extends Model
{
    use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_jenis_berkas';
	protected $fillable  = ['id', 'nama', 'keterangan', 'kode', 'format', 'size', 'penamaan'];
}
