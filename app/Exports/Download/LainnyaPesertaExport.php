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

class LainnyaPesertaExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'No Peserta', 'Nama', 'JK', 'Agama', 'Status Perkawinan', 'Ijazah Nomor', 'Ijazah Tanggal', 'Ijazah Prodi / PT', 'SKCK Pejabat', 'SKCK Nomor', 'SKCK Tanggal', 'Suket Jasroh Pejabat', 'Suket Jasroh Nomor', 'Suket Jasroh Tanggal', 'Suket NAPZA Pejabat', 'Suket NAPZA Nomor', 'Suket NAPZA Tanggal', 'Keterangan Lainnya'
        ];
    }

    public function collection()
    {
        $table = DB::table('tabref_data_peserta')
                    ->leftJoin('daper_lainnya', 'daper_lainnya.peserta_id', '=', 'tabref_data_peserta.id')
                    ->select(
                        'tabref_data_peserta.*', 
                        'daper_lainnya.jk', 'daper_lainnya.agama', 'daper_lainnya.status_perkawinan', 'daper_lainnya.ijazah_nomor', 
                        'daper_lainnya.ijazah_tanggal', 'daper_lainnya.ijazah_prodi', 'daper_lainnya.skck_pejabat', 'daper_lainnya.skck_nomor', 
                        'daper_lainnya.skck_tanggal', 'daper_lainnya.suket_sehat_pejabat', 'daper_lainnya.suket_sehat_nomor', 'daper_lainnya.suket_sehat_tanggal', 
                        'daper_lainnya.suket_napza_pejabat', 'daper_lainnya.suket_napza_nomor', 'daper_lainnya.suket_napza_tanggal', 'daper_lainnya.keterangan_lainnya'
                    )->get();
        $data = [];
        foreach ($table as $t) {
            $data[] = array(
                'no_peserta'          => $t->no_peserta,
                'nama'                => $t->nama,
                'jk'                  => $t->jk,
                'agama'               => $t->agama,
                'status_perkawinan'   => $t->status_perkawinan,
                'ijazah_nomor'        => $t->ijazah_nomor,
                'ijazah_tanggal'      => $t->ijazah_tanggal,
                'ijazah_prodi'        => $t->ijazah_prodi,
                'skck_pejabat'        => $t->skck_pejabat,
                'skck_nomor'          => $t->skck_nomor,
                'skck_tanggal'        => $t->skck_tanggal,
                'suket_sehat_pejabat' => $t->suket_sehat_pejabat,
                'suket_sehat_nomor'   => $t->suket_sehat_nomor,
                'suket_sehat_tanggal' => $t->suket_sehat_tanggal,
                'suket_napza_pejabat' => $t->suket_napza_pejabat,
                'suket_napza_nomor'   => $t->suket_napza_nomor,
                'suket_napza_tanggal' => $t->suket_napza_tanggal,
                'keterangan_lainnya'  => $t->keterangan_lainnya,
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
