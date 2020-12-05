<?php

namespace Modules\DataPerorangan\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class DataLainnya extends Model
{
    use Uuid;
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'daper_lainnya';
	protected $fillable  = ['id', 'peserta_id', 'jk', 'agama', 'status_perkawinan', 'ijazah_nomor', 'ijazah_tanggal', 'ijazah_prodi', 'skck_pejabat', 'skck_nomor', 'skck_tanggal', 'suket_sehat_pejabat', 'suket_sehat_nomor', 'suket_sehat_tanggal', 'suket_napza_pejabat', 'suket_napza_nomor', 'suket_napza_tanggal', 'keterangan_lainnya'];
}
