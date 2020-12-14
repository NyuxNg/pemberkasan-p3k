<?php

namespace Modules\TabelRefrensi\Http\Controllers;

use App\Exports\TabelRefrensi\DataProvinsiExport;
use App\Imports\TabelRefrensi\DataProvinsiImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\DataProvinsi;
use Yajra\DataTables\DataTables;

class DataProvinsiController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::data-provinsi.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "DataProvinsiExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File DataProvinsiExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new DataProvinsiImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    DataProvinsi::updateOrCreate(
                        [
                            'id'    => $importData[0][$i][0],
                        ],
                        [
                            'id'    => $importData[0][$i][0],
                            'nama'  => $importData[0][$i][1],
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
        return Excel::download(new DataProvinsiExport, "DataProvinsiExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DataProvinsi::orderBy('nama');
            return DataTables::of($model)
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return dashbord_url();
        }
    }
}