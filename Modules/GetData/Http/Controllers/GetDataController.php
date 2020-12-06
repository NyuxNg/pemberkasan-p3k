<?php

namespace Modules\GetData\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\TabelRefrensi\Entities\DataPeserta;
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
}
