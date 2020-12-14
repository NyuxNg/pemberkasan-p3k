<?php

namespace Modules\TabelRefrensi\Entities;

use Illuminate\Database\Eloquent\Model;

class DataProvinsi extends Model
{
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_data_provinsi';
	protected $fillable  = ['id', 'nama'];
}
