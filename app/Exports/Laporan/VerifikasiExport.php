<?php

namespace App\Exports\Laporan;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class VerifikasiExport extends DefaultValueBinder implements WithCustomValueBinder, WithHeadings, FromCollection, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'No. Peserta', 'Nama', 'DRH', 'SPCP', 'FOTOP3K', 'SKETSEHAT', 'SKETNAPZA', 'IJZPEND', 'IJZNILAI', 'SKCK'
        ];
    }

    public function collection()
    {
    	$berkas = DB::table('pemberkasan_berkas')->select('peserta_id')->groupBy('peserta_id')->get();
            $data = [];
            foreach ($berkas as $b) {
                $jenisBerkas = $this->jenisBerkas();
                $data[] = array(
                    'no_peserta' => DataPeserta::find($b->peserta_id)->no_peserta, 
                    'nama'       => DataPeserta::find($b->peserta_id)->nama, 
                    'DRH'        => $this->berkas($b->peserta_id, 'DRH'),
                    'SPCP'       => $this->berkas($b->peserta_id, 'SPCP'),
                    'FOTOP3K'    => $this->berkas($b->peserta_id, 'FOTOP3K'),
                    'SKETSEHAT'  => $this->berkas($b->peserta_id, 'SKETSEHAT'),
                    'SKETNAPZA'  => $this->berkas($b->peserta_id, 'SKETNAPZA'),
                    'IJZPEND'    => $this->berkas($b->peserta_id, 'IJZPEND'),
                    'IJZNILAI'   => $this->berkas($b->peserta_id, 'IJZNILAI'),
                    'SKCK'       => $this->berkas($b->peserta_id, 'SKCK'),
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

    private function jenisBerkas()
    {
        $jenisBerkas = DB::table('tabref_jenis_berkas')->select('kode')->get()->toArray();
        $jB = array_column($jenisBerkas, 'kode');
        return $jB;
    }

    private function berkas($peserta_id, $jberkas)
    {
        $berkas = Berkas::join('tabref_jenis_berkas', 'tabref_jenis_berkas.id', '=', 'pemberkasan_berkas.jberkas_id')
            ->where('tabref_jenis_berkas.kode', $jberkas)
            ->where('pemberkasan_berkas.peserta_id', $peserta_id)
            ->select('pemberkasan_berkas.status')->first();

        if (isset($berkas)) {
            return $berkas->status;
        }
    }
}
