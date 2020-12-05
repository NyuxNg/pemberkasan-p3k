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

class JenisBerkasExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'nama', 'kode', 'format', 'size', 'keterangan'
        ];
    }

    public function collection()
    {
    	return 	DB::table('tabref_jenis_berkas')->select('nama', 'kode', 'format', 'size', 'keterangan')->get();
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
