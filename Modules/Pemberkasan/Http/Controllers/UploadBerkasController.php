<?php

namespace Modules\Pemberkasan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;
use Modules\TabelRefrensi\Entities\JenisBerkas;
use Yajra\DataTables\DataTables;

class UploadBerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::where('peserta_id', session()->get('peserta_id'))->first();
        if (is_null($berkas)) {
            $jberkas = JenisBerkas::all();
            foreach ($jberkas as $jb) {
                Berkas::create([
                    'peserta_id' => session()->get('peserta_id'),
                    'jberkas_id' => $jb->id,
                ]);
            }
        }
        return view('pemberkasan::upload.index');
    }

    public function upload(Request $request, $id)
    {
        if ($request->ajax()) {
            $request->validate(['file' => 'required'], [], ['file' => 'File'] );

            $post                       = $request->all();
            $file                       = Input::file('file');
            $getClientOriginalName      = $file->getClientOriginalName();
            $getClientOriginalExtension = $file->getClientOriginalExtension();
            $getClientSize              = ($file->getClientSize() / 1024);

            try {
                $berkas  = Berkas::find($id);
                $peserta = DataPeserta::find($berkas->peserta_id);
                $jberkas = JenisBerkas::find($berkas->jberkas_id);

                if ($jberkas->format != $getClientOriginalExtension || ($jberkas->size / 1024) < $getClientSize) {
                    return response()->json([
                        'errors' => true,
                        'message' => 'Berkas yang diupload tidak sesuai dengan <b>Format</b> dan <b>Ukuran</b> yang telah ditentukan'
                    ]);
                }
                else{
                    $filename = $jberkas->kode . "_" .$peserta->no_peserta . "." .$getClientOriginalExtension;
                    $file->move(public_path('upload/berkas/') . $peserta->no_peserta . "/", $filename);

                    Berkas::where('id', $id)->update([
                        'file'   => $filename,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Upload Berkas Berhasil'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function kirim(Request $request)
    {
        if ($request->ajax()) {
            $berkas = Berkas::where('peserta_id', session()->get('peserta_id'))->get();

            foreach ($berkas as $b) {
                if($b->status == null || $b->status == "Ditolak"){
                    Berkas::where('id', $b->id)->update([
                        'status'     => 'Proses',
                        'keterangan' => null,
                    ]);
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Kirim Berkas Berhasil'
            ]);
        }
    }

    public function cekstatus(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('pemberkasan_berkas')
                    ->join('tabref_jenis_berkas', 'tabref_jenis_berkas.id', '=', 'pemberkasan_berkas.jberkas_id')
                    ->join('tabref_data_peserta', 'tabref_data_peserta.id', '=', 'pemberkasan_berkas.peserta_id')
                    ->where('pemberkasan_berkas.id', $id)
                    ->select('pemberkasan_berkas.*', 'tabref_jenis_berkas.nama as nama_jberkas')->first();
            return response()->json([
                'success' => true,
                'content' => $data
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('pemberkasan_berkas')
                    ->join('tabref_jenis_berkas', 'tabref_jenis_berkas.id', '=', 'pemberkasan_berkas.jberkas_id')
                    ->join('tabref_data_peserta', 'tabref_data_peserta.id', '=', 'pemberkasan_berkas.peserta_id')
                    ->where('pemberkasan_berkas.peserta_id', session()->get('peserta_id'))
                    ->select('pemberkasan_berkas.*', 
                        'tabref_jenis_berkas.nama as nama_jberkas', 'tabref_jenis_berkas.keterangan as keterangan_jberkas',
                        'tabref_jenis_berkas.format as format_jberkas', 'tabref_jenis_berkas.size as size_jberkas',
                        'tabref_data_peserta.no_peserta'
                    );

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    $btn = '';
                    if (empty($model->status) || $model->status == "Ditolak") {
                        $btn .=  '<a href="'.route('berkas.upload.upload', $model->id).'" class="btn btn-info text-dark btn-sm mx-1 btn-upload"><i class="fa fa-upload mr-2"></i>Upload</a>';
                    }
                    if (!empty($model->status)) {
                        $btn .=  '<a href="'.route('berkas.upload.cekstatus', $model->id).'" class="btn btn-warning btn-sm mx-1 btn-cekstatus"><i class="fa fa-check mr-2"></i>Status</a>';
                    }

                    if (!empty($model->file)) {
                        $btn .=  '<a href="'. asset('public/upload/berkas') . "/" . $model->no_peserta . "/" . $model->file .'" target="_blank" class="btn btn-primary btn-sm mx-1"><i class="fa fa-eye mr-2"></i>Lihat</a>';
                    }

                    return $btn;
                })
                ->editColumn('keterangan_jberkas', function ($model) {
                    return $model->keterangan_jberkas . "<br/>Format : <b>" . $model->format_jberkas . "</b>, Size : <b>" . round($model->size_jberkas / 1024) . " KB</b>";
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'keterangan_jberkas'])
                ->make(true);
        }
        else{
            return redirect()->route('dashboad.index');
        }
    }
}
