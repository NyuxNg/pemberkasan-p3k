<?php

namespace Modules\GetData\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\TabelRefrensi\Entities\DataDesa;
use Modules\TabelRefrensi\Entities\DataKabupaten;
use Modules\TabelRefrensi\Entities\DataKecamatan;
use Modules\TabelRefrensi\Entities\DataPeserta;
use Modules\TabelRefrensi\Entities\DataProvinsi;
use Spatie\Permission\Models\Role;

class GetDataController extends Controller
{
    public function roles(Request $request)
    {
        if ($request->ajax()) {
            $data = array(
                'success' => true,
                'content' => Role::whereIn('name',['admin', 'verifikator'])->orderBy('description')->get(), 
            );
            return response()->json($data);
        }
        else{
            return redirect()->route('dashboard.index');
        }
    }

    public function peserta(Request $request)
    {
        if ($request->ajax()) {
            $table = DB::table('tabref_data_peserta')
                    ->join('tabref_data_kabupaten', 'tabref_data_kabupaten.id', '=', 'tabref_data_peserta.kab_kota_id')
                    ->where('no_peserta', $request->get('no_peserta'))
                    ->select('tabref_data_peserta.*', 'tabref_data_kabupaten.nama as nama_kabupaten')->first();
            $data = array(
                'no_peserta'      => $table->no_peserta, 
                'nama'            => $table->nama, 
                'tanggal_lahir'   => $table->nama_kabupaten . ", " . tanggal($table->tanggal_lahir), 
                'pendidikan'      => $table->pendidikan, 
                'unit_penempatan' => $table->unit_penempatan, 
                'jabatan'         => $table->jabatan, 
            );
            $data = array(
                'success' => true,
                'content' => $data, 
            );
            return response()->json($data);
        }
        else{
            return redirect()->route('dashboard.index');
        }
    }

    public function provinsi(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => DataProvinsi::orderBy('nama')->get()
            ]);
        }
    }

    public function kabupaten(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('provinsi_id')) {
                return response()->json([
                    'success' => true,
                    'content' => DataKabupaten::where('provinsi_id', $request->get('provinsi_id'))->orderBy('nama')->get()
                ]);
            }
            else{
                return response()->json([
                    'success' => true,
                    'content' => DataKabupaten::orderBy('nama')->get()
                ]);
            }
        }
    }

    public function kecamatan(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('kabupaten_id')) {
                return response()->json([
                    'success' => true,
                    'content' => DataKecamatan::where('kabupaten_id', $request->get('kabupaten_id'))->orderBy('nama')->get()
                ]);
            }
            else{
                return response()->json([
                    'success' => true,
                    'content' => DataKecamatan::orderBy('nama')->get()
                ]);
            }
        }
    }

    public function desa(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('kecamatan_id')) {
                return response()->json([
                    'success' => true,
                    'content' => DataDesa::where('kecamatan_id', $request->get('kecamatan_id'))->orderBy('nama')->get()
                ]);
            }
            else{
                return response()->json([
                    'success' => true,
                    'content' => DataDesa::orderBy('nama')->get()
                ]);
            }
        }
    }
}
