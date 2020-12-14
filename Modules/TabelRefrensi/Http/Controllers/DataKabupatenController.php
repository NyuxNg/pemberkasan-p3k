<?php

namespace Modules\TabelRefrensi\Http\Controllers;

use App\Exports\TabelRefrensi\DataKabupatenExport;
use App\Imports\TabelRefrensi\DataKabupatenImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\DataKabupaten;
use Yajra\DataTables\DataTables;

class DataKabupatenController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::data-kabupaten.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "DataKabupatenExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File DataKabupatenExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new DataKabupatenImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    DataKabupaten::updateOrCreate(
                        [
                            'id'    => $importData[0][$i][0],
                        ],
                        [
                            'id'          => $importData[0][$i][0],
                            'nama'        => $importData[0][$i][1],
                            'provinsi_id' => $importData[0][$i][2],
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
        return Excel::download(new DataKabupatenExport, "DataKabupatenExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('tabref_data_kabupaten')->join('tabref_data_provinsi', 'tabref_data_provinsi.id', '=', 'tabref_data_kabupaten.provinsi_id')
                        ->select('tabref_data_kabupaten.*', 'tabref_data_provinsi.nama as provinsi_nama')
                        ->orderBy('tabref_data_kabupaten.id');
            return DataTables::of($model)
            ->filterColumn('provinsi_nama', function($query, $keyword) {
                $query->where('tabref_data_provinsi.nama', 'like', ["%{$keyword}%"]);
            })
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return dashbord_url();
        }
    }
}
