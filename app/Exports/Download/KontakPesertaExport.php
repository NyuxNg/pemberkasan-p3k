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

class KontakPesertaExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'No Peserta', 'Nama', 'No HP', 'E-Mail', 'Alamat'
        ];
    }

    public function collection()
    {
    	$table = DB::table('tabref_data_peserta')
                    ->leftJoin('daper_kontak', 'daper_kontak.peserta_id', '=', 'tabref_data_peserta.id')
                    ->select(
                    	'tabref_data_peserta.*', 
                    	'daper_kontak.no_hp', 'daper_kontak.email', 'daper_kontak.alamat'
                    )->get();
        $data = [];
        foreach ($table as $t) {
            $data[] = array(
				'no_peserta' => $t->no_peserta,
				'nama'       => $t->nama,
				'no_hp'      => $t->no_hp,
				'email'      => $t->email,
				'alamat'     => $t->alamat,
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
