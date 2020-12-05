<?php

namespace Modules\DataPerorangan\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\DataPerorangan\Entities\DataLainnya;

class DataLainnyaController extends Controller
{
    public function index()
    {
        $lainnya = DataLainnya::where('peserta_id', session()->get('peserta_id'))->first();
        if (is_null($lainnya)) {
            DataLainnya::create([
                'peserta_id'          => session()->get('peserta_id'),
            ]);
        }
        $data = array(
            'lainnya' => DataLainnya::where('peserta_id', session()->get('peserta_id'))->first()
        );
        return view('dataperorangan::data-lainnya.index', $data);
    }


    public function store(Request $request)
    {
        DataLainnya::updateOrCreate(
            [
                'peserta_id' => session()->get('peserta_id'),
            ],
            [
                'peserta_id' => session()->get('peserta_id'),
                'jk'                  => $request->get('jk'),
                'agama'               => $request->get('agama'),
                'status_perkawinan'   => $request->get('status_perkawinan'),
                'ijazah_nomor'        => $request->get('ijazah_nomor'),
                'ijazah_tanggal'      => $request->get('ijazah_tanggal'),
                'ijazah_prodi'        => $request->get('ijazah_prodi'),
                'skck_nomor'          => $request->get('skck_nomor'),
                'skck_tanggal'        => $request->get('skck_tanggal'),
                'skck_pejabat'        => $request->get('skck_pejabat'),
                'suket_sehat_nomor'   => $request->get('suket_sehat_nomor'),
                'suket_sehat_tanggal' => $request->get('suket_sehat_tanggal'),
                'suket_sehat_pejabat' => $request->get('suket_sehat_pejabat'),
                'suket_napza_nomor'   => $request->get('suket_napza_nomor'),
                'suket_napza_tanggal' => $request->get('suket_napza_tanggal'),
                'suket_napza_pejabat' => $request->get('suket_napza_pejabat'),
                'keterangan_lainnya'  => $request->get('keterangan_lainnya'),
            ]
        );

        return redirect()->back()->with('success', 'Update Data Lainnya Berhasil');
    }
}

