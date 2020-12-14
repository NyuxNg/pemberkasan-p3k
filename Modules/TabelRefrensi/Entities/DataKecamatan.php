<?php

namespace Modules\TabelRefrensi\Entities;

use Illuminate\Database\Eloquent\Model;

class DataKecamatan extends Model
{
   	protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_data_kecamatan';
	protected $fillable  = ['id', 'nama', 'kabupaten_id'];
}
