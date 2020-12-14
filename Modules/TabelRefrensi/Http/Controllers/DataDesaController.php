<?php

namespace Modules\TabelRefrensi\Http\Controllers;

use App\Exports\TabelRefrensi\DataDesaExport;
use App\Imports\TabelRefrensi\DataDesaImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\DataDesa;
use Yajra\DataTables\DataTables;

class DataDesaController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::data-desa.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "DataDesaExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File DataDesaExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new DataDesaImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    DataDesa::updateOrCreate(
                        [
                            'id'    => $importData[0][$i][0],
                        ],
                        [
                            'id'           => $importData[0][$i][0],
                            'nama'         => $importData[0][$i][1],
                            'kecamatan_id' => $importData[0][$i][2],
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
            return dashbord_url();
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new DataDesaExport, "DataDesaExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('tabref_data_desa')->join('tabref_data_kecamatan', 'tabref_data_kecamatan.id', '=', 'tabref_data_desa.kecamatan_id')
                        ->select('tabref_data_desa.*', 'tabref_data_kecamatan.nama as kecamatan_nama')
                        ->orderBy('tabref_data_desa.id');
            return DataTables::of($model)
            ->filterColumn('kecamatan_nama', function($query, $keyword) {
                $query->where('tabref_data_kecamatan.nama', 'like', ["%{$keyword}%"]);
            })
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return dashbord_url();
        }
    }
}

