<?php

namespace App\Exports\TabelRefrensi;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class DataKabupatenExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'ID',  'Nama Kabupaten', 'Provinsi ID'
        ];
    }

    public function collection()
    {
    	return 	DB::table('tabref_data_kabupaten')->select('id', 'nama', 'provinsi_id')->get();
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
