<?php

namespace App\Exports\Download;

use App\DataPeserta;
use Maatwebsite\Excel\Concerns\FromCollection;

class Peserta implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataPeserta::all();
    }
}
