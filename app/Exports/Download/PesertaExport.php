<?php

namespace App\Exports\Download;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PesertaExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'No Peserta', 'Nama', 'TTL', 'Pendidikan', 'Unit Penempatan', 'Jabatan'
        ];
    }

    public function collection()
    {
    	$table = DB::table('tabref_data_peserta')
                    ->join('tabref_data_kabupaten', 'tabref_data_kabupaten.id', '=', 'tabref_data_peserta.kab_kota_id')
                    ->select('tabref_data_peserta.*', 'tabref_data_kabupaten.nama as nama_kabupaten')->get();
        $data = [];
        foreach ($table as $t) {
            $data[] = array(
                'no_peserta'      => $t->no_peserta,
                'nama'            => $t->nama,
                'tanggal_lahir'   => $t->nama_kabupaten . ", " . tanggal($t->tanggal_lahir),
                'pendidikan'      => $t->pendidikan,
                'unit_penempatan' => $t->unit_penempatan,
                'jabatan'         => $t->jabatan,
            );
        }

        return collect($data);
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
