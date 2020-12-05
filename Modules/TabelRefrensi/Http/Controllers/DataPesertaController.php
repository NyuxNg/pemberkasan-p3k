<?php

namespace Modules\TabelRefrensi\Http\Controllers;

use App\Exports\TabelRefrensi\DataPesertaExport;
use App\Imports\TabelRefrensi\DataPesertaImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\DataPeserta;
use Yajra\DataTables\DataTables;

class DataPesertaController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::data-peserta.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "DataPesertaExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File DataPesertaExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new DataPesertaImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    DataPeserta::updateOrCreate(
                        [
                            'no_peserta'    => $importData[0][$i][0],
                        ],
                        [
                            'no_peserta'      => $importData[0][$i][0],
                            'nama'            => $importData[0][$i][1],
                            'kab_kota_id'     => $importData[0][$i][2],
                            'tanggal_lahir'   => $importData[0][$i][3],
                            'pendidikan'      => $importData[0][$i][4],
                            'unit_penempatan' => $importData[0][$i][5],
                            'jabatan'         => $importData[0][$i][6],
                        ]
                    );
                }
                return response()->json([
                    'success' => true,
                    'message' => "Data berhasil di Import!",
                ]);
            }
        }
        else{
            return redirect()->route('dashboad.index');
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new DataPesertaExport, "DataPesertaExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DataPeserta::orderBy('nama');
            return DataTables::of($model)
            ->editColumn('tanggal_lahir', function ($model) {
                return $model->kabupaten->nama . ", " . tanggal($model->tanggal_lahir);
            })
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return redirect()->route('dashboad.index');
        }
    }
}

