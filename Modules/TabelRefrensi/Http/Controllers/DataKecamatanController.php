<?php

namespace Modules\TabelRefrensi\Http\Controllers;

use App\Exports\TabelRefrensi\DataKecamatanExport;
use App\Imports\TabelRefrensi\DataKecamatanImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\DataKecamatan;
use Yajra\DataTables\DataTables;

class DataKecamatanController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::data-kecamatan.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "DataKecamatanExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File DataKecamatanExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new DataKecamatanImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    DataKecamatan::updateOrCreate(
                        [
                            'id'    => $importData[0][$i][0],
                        ],
                        [
                            'id'          => $importData[0][$i][0],
                            'nama'        => $importData[0][$i][1],
                            'kabupaten_id' => $importData[0][$i][2],
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
        return Excel::download(new DataKecamatanExport, "DataKecamatanExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('tabref_data_kecamatan')->join('tabref_data_kabupaten', 'tabref_data_kabupaten.id', '=', 'tabref_data_kecamatan.kabupaten_id')
                        ->select('tabref_data_kecamatan.*', 'tabref_data_kabupaten.nama as kabupaten_nama')
                        ->orderBy('tabref_data_kecamatan.id');
            return DataTables::of($model)
            ->filterColumn('kabupaten_nama', function($query, $keyword) {
                $query->where('tabref_data_kabupaten.nama', 'like', ["%{$keyword}%"]);
            })
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return dashbord_url();
        }
    }
}