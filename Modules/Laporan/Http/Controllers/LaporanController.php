<?php

namespace Modules\Laporan\Http\Controllers;

use App\Exports\Laporan\VerifikasiExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan::index');
    }

    public function download(Request $request)
    {
        return Excel::download(new VerifikasiExport, "VerifikasiExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $berkas = DB::table('pemberkasan_berkas')->select('peserta_id')->groupBy('peserta_id')->get();
            $model = [];
            foreach ($berkas as $b) {
                $jenisBerkas = $this->jenisBerkas();
                $model[] = array(
                    'id'         => $b->peserta_id, 
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

            return DataTables::of(collect($model))->addIndexColumn()->make(true);
        }
        else{
            return dashbord_url();
        }
    }

    // Private function
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
