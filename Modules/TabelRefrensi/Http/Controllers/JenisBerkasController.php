<?php

namespace Modules\TabelRefrensi\Http\Controllers;
use App\Exports\TabelRefrensi\JenisBerkasExport;
use App\Imports\TabelRefrensi\JenisBerkasImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\TabelRefrensi\Entities\JenisBerkas;
use Yajra\DataTables\DataTables;

class JenisBerkasController extends Controller
{
    public function index()
    {
        return view('tabelrefrensi::jenis-berkas.index');
    }

    public function import(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                  = $request->all();
            $file                  = Input::file('file');
            $getClientOriginalName = $file->getClientOriginalName();

            if ($getClientOriginalName != "JenisBerkasExport.xlsx") {
                return response()->json([
                    'message' => 'Invalid File Name',
                    'errors'  => [
                        'file' => 'Pastikan anda mengupload File JenisBerkasExport.xlsx'
                    ]
                ], 422);
            }
            else{
                $importData = Excel::toArray(new JenisBerkasImport, request()->file('file'));
                for ($i=1; $i < sizeof($importData[0]); $i++) {
                    JenisBerkas::updateOrCreate(
                        [
                            'kode' => $importData[0][$i][3],
                        ],
                        [
                            'nama'       => $importData[0][$i][1],
                            'keterangan' => $importData[0][$i][2],
                            'kode'       => $importData[0][$i][3],
                            'format'     => $importData[0][$i][4],
                            'size'       => $importData[0][$i][5],
                            'penamaan'   => $importData[0][$i][6],
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
        return Excel::download(new JenisBerkasExport, "JenisBerkasExport.xlsx");
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   JenisBerkas::orderBy('nama');
            return DataTables::of($model)
            ->editColumn('size', function($model) {
                return round($model->size / 1024);
            })
            ->addIndexColumn()
            ->make(true);
        }
        else{
            return redirect()->route('dashboad.index');
        }
    }
}

