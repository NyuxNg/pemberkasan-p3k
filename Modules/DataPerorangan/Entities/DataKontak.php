<?php

namespace Modules\DataPerorangan\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;
use Modules\TabelRefrensi\Entities\DataPeserta;

class DataKontak extends Model
{
    use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'daper_kontak';
	protected $fillable  = ['id', 'peserta_id', 'no_hp', 'email', 'alamat'];
}
