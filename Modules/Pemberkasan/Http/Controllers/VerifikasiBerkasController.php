<?php

namespace Modules\Pemberkasan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Pemberkasan\Entities\Berkas;
use Yajra\DataTables\DataTables;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        return view('pemberkasan::verifikasi.index');
    }

    public function proses(Request $request, $id)
    {
        if ($request->ajax()) {
            $berkas = Berkas::find($id);
            
            if($request->get('status') == "Diterima") {
                Berkas::where('id', $berkas->id)->update([
                    'status'         => $request->get('status'),
                    'verifikator_id' => Auth::id(),
                ]);
            }
            else{
                Berkas::where('id', $berkas->id)->update([
                    'status'         => $request->get('status'),
                    'keterangan'     => $request->get('keterangan'),
                    'verifikator_id' => Auth::id(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Verifikasi berkas berhasil'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('pemberkasan_berkas')
                    ->join('tabref_jenis_berkas', 'tabref_jenis_berkas.id', '=', 'pemberkasan_berkas.jberkas_id')
                    ->join('tabref_data_peserta', 'tabref_data_peserta.id', '=', 'pemberkasan_berkas.peserta_id')
                    ->select('pemberkasan_berkas.*', 'tabref_jenis_berkas.nama as nama_jberkas', 'tabref_data_peserta.no_peserta');
            if ($request->has('no_peserta')) {
                $model->where('tabref_data_peserta.no_peserta', $request->get('no_peserta'));
            }

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    $btn = '';
                    if ($model->status == "Proses") {
                        $btn .=  '<a href="'.$model->id.'" class="btn bg-navy btn-sm mx-1 btn-verifikasi"><i class="fa fa-check mr-2"></i>Verifikasi</a>';
                    }

                    if ($model->status == "Diterima") {
                        $btn .=  '<a href="'.$model->id.'" class="btn btn-danger btn-sm mx-1 btn-ditolak"><i class="fa fa-thumbs-o-down mr-2"></i>Ditolak</a>';
                    }

                    if ($model->status == "Ditolak") {
                        $btn .=  '<a href="'.$model->id.'" class="btn btn-success btn-sm mx-1 btn-diterima"><i class="fa fa-thumbs-o-up mr-2"></i>Diterima</a>';
                    }
                    
                    if (!empty($model->file)) {
                        $btn .=  '<a href="'. asset('public/upload/berkas') . "/" . $model->no_peserta . "/" . $model->file .'" target="_blank" class="btn btn-primary btn-sm mx-1"><i class="fa fa-eye mr-2"></i>Lihat</a>';
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
