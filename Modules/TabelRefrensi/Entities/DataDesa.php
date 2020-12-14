<?php

namespace Modules\TabelRefrensi\Entities;

use Illuminate\Database\Eloquent\Model;

class DataDesa extends Model
{
    protected $keyType   = 'string';
	public $incrementing = false;
	public $table        = 'tabref_data_desa';
	protected $fillable  = ['id', 'nama', 'kecamatan_id'];
}
