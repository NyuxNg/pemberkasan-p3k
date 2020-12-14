<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\DRH\Entities\KeteranganPerorangan;

class KeteranganPeroranganController extends Controller
{
    public function index()
    {
        $ket_perorangan  = KeteranganPerorangan::where('peserta_id', session()->get('peserta_id'))->first();
        $data_perorangan = array(
            'nik_result'               => (isset($ket_perorangan)) ? $ket_perorangan->nik : "", 
            'nama_result'              => (isset($ket_perorangan)) ? $ket_perorangan->nama : "", 
            'ttl_result'               => (isset($ket_perorangan)) ? $ket_perorangan->tempat_lahir->nama . ", " . tanggal($ket_perorangan->tanggal_lahir) : "", 
            'jk_result'                => (isset($ket_perorangan)) ? $ket_perorangan->jk : "", 
            'agama_result'             => (isset($ket_perorangan)) ? $ket_perorangan->agama : "", 
            'status_perkawinan_result' => (isset($ket_perorangan)) ? $ket_perorangan->status_perkawinan : "", 
            'email_result'             => (isset($ket_perorangan)) ? $ket_perorangan->email : "", 
            'no_hp_result'             => (isset($ket_perorangan)) ? $ket_perorangan->no_hp : "", 
            'kegemaran_result'         => (isset($ket_perorangan)) ? $ket_perorangan->kegemaran : "", 
            'provinsi_result'          => (isset($ket_perorangan)) ? $ket_perorangan->provinsi->nama : "", 
            'kabupaten_result'         => (isset($ket_perorangan)) ? $ket_perorangan->kabupaten->nama : "", 
            'kecamatan_result'         => (isset($ket_perorangan)) ? $ket_perorangan->kecamatan->nama : "", 
            'desa_result'              => (isset($ket_perorangan)) ? $ket_perorangan->desa->nama : "", 
            'jalan_result'             => (isset($ket_perorangan)) ? $ket_perorangan->jalan : "", 
            'tinggi_badan_result'      => (isset($ket_perorangan)) ? $ket_perorangan->tinggi_badan : "", 
            'berat_badan_result'       => (isset($ket_perorangan)) ? $ket_perorangan->berat_badan : "", 
            'rambut_result'            => (isset($ket_perorangan)) ? $ket_perorangan->rambut : "", 
            'bentuk_muka_result'       => (isset($ket_perorangan)) ? $ket_perorangan->bentuk_muka : "", 
            'warna_kulit_result'       => (isset($ket_perorangan)) ? $ket_perorangan->warna_kulit : "", 
            'ciri_khas_result'         => (isset($ket_perorangan)) ? $ket_perorangan->ciri_khas : "", 
            'cacat_tubuh_result'       => (isset($ket_perorangan)) ? $ket_perorangan->cacat_tubuh : ""
        );
        $data = array(
            'perorangan' => $data_perorangan, 
        );

        return view('drh::perorangan.index', $data);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                KeteranganPerorangan::updateOrCreate(
                    [
                        'peserta_id'        => session()->get('peserta_id'),
                    ],
                    [
                        'peserta_id'        => session()->get('peserta_id'),
                        'nik'               => $request->get('nik'),
                        'nama'              => $request->get('nama'),
                        'tempat_lahir_id'   => $request->get('tempat_lahir_id'),
                        'tanggal_lahir'     => $request->get('tanggal_lahir'),
                        'jk'                => $request->get('jk'),
                        'agama'             => $request->get('agama'),
                        'status_perkawinan' => $request->get('status_perkawinan'),
                        'email'             => $request->get('email'),
                        'no_hp'             => $request->get('no_hp'),
                        'provinsi_id'       => $request->get('provinsi_id'),
                        'kabupaten_id'      => $request->get('kabupaten_id'),
                        'kecamatan_id'      => $request->get('kecamatan_id'),
                        'desa_id'           => $request->get('desa_id'),
                        'jalan'             => $request->get('jalan'),
                        'tinggi_badan'      => $request->get('tinggi_badan'),
                        'berat_badan'       => $request->get('berat_badan'),
                        'rambut'            => $request->get('rambut'),
                        'bentuk_muka'       => $request->get('bentuk_muka'),
                        'warna_kulit'       => $request->get('warna_kulit'),
                        'ciri_khas'         => $request->get('ciri_khas'),
                        'cacat_tubuh'       => $request->get('cacat_tubuh'),
                        'kegemaran'         => $request->get('kegemaran'),
                    ]
                );

                return response()->json([
                    'success' => true,
                    'message' => 'Update Data Berhasil!'
                ]);

            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $data = KeteranganPerorangan::where('peserta_id', session()->get('peserta_id'))->first();
            if (isset($data)) {
                return response()->json([
                    'success' => true,
                    'content' => $data,
                ]);
            }
        }
    }

    // Private Function
    private function attributes()
    {
        return [
            'agama'             => 'Agama',
            'desa_id'              => 'Desa',
            'email'             => 'EMail',
            'jk'                => 'Jenis Kelamin',
            'kabupaten_id'      => 'Kabupaten',
            'kecamatan_id'      => 'Kecamatan',
            'nama'              => 'Nama',
            'nik'               => 'NIK',
            'no_hp'             => 'No. HP / WA',
            'provinsi_id'       => 'Provinsi',
            'status_perkawinan' => 'Status Pernikahan',
            'tanggal_lahir'     => 'Tanggal Lahir',
            'tempat_lahir_id'   => 'Tempat Lahir'
        ];
    }

    private function rules()
    {
        return [
            'agama'             => 'required',
            'desa_id'           => 'required',
            'email'             => 'required|email',
            'jk'                => 'required',
            'kabupaten_id'      => 'required',
            'kecamatan_id'      => 'required',
            'nama'              => 'required',
            'nik'               => 'required|numeric',
            'no_hp'             => 'required|numeric',
            'provinsi_id'       => 'required',
            'status_perkawinan' => 'required',
            'tanggal_lahir'     => 'required',
            'tempat_lahir_id'   => 'required'
        ];
    }
}
