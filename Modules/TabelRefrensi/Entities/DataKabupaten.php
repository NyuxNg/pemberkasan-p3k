<?php

namespace Modules\TabelRefrensi\Entities;

use Illuminate\Database\Eloquent\Model;

class DataKabupaten extends Model
{
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_data_kabupaten';
	protected $fillable  = ['id', 'nama', 'provinsi_id'];
}
