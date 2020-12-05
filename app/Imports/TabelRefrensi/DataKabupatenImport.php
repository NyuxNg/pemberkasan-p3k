<?php

namespace App\Imports\TabelRefrensi;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\TabelRefrensi\Entities\DataKabupaten;

class DataKabupatenImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataKabupaten([
            //
        ]);
    }
}
