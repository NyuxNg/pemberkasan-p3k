<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Pekerjaan;
use Yajra\DataTables\Facades\DataTables;

class PekerjaanController extends Controller
{
    public function index()
    {
        return view('drh::pekerjaan.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Pekerjaan::create([
                    'peserta_id'               => session()->get('peserta_id'),
                    'instansi'                 => $request->get('instansi'),
                    'jabatan'                  => $request->get('jabatan'),
                    'mulai'                    => $request->get('mulai'),
                    'selesai'                  => $request->get('selesai'),
                    'gaji_pokok'               => $request->get('gaji_pokok'),
                    'sk_nomor'                 => $request->get('sk_nomor'),
                    'sk_tanggal'               => $request->get('sk_tanggal'),
                    'sk_pejabat_penandatangan' => $request->get('sk_pejabat_penandatangan'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Pekerjaan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'errors'  => true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    public function edit($id)
    {
        $data = Pekerjaan::findOrFail($id);
        return response()->json([
            'success' => true,
            'content' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Pekerjaan::where('id', $id)->update([
                    'instansi'                 => $request->get('instansi'),
                    'jabatan'                  => $request->get('jabatan'),
                    'mulai'                    => $request->get('mulai'),
                    'selesai'                  => $request->get('selesai'),
                    'gaji_pokok'               => $request->get('gaji_pokok'),
                    'sk_nomor'                 => $request->get('sk_nomor'),
                    'sk_tanggal'               => $request->get('sk_tanggal'),
                    'sk_pejabat_penandatangan' => $request->get('sk_pejabat_penandatangan'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Pekerjaan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Pekerjaan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Pekerjaan Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Pekerjaan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.pekerjaan.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.pekerjaan.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('mulai', function ($model) {
                return tanggal($model->mulai);
            })
            ->editColumn('sk_tanggal', function ($model) {
                return tanggal($model->sk_tanggal);
            })
            ->editColumn('selesai', function ($model) {
                return tanggal($model->selesai);
            })
            ->editColumn('gaji_pokok', function ($model) {
                return number_format($model->gaji_pokok);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'instansi'                 => 'Instansi',
            'jabatan'                  => 'Jabatan',
            'mulai'                    => 'Mulai',
            'selesai'                  => 'Selesai',
            'gaji_pokok'               => 'Gaji Pokok',
            'sk_nomor'                 => 'No. SK',
            'sk_tanggal'               => 'Tanggal SK',
            'sk_pejabat_penandatangan' => 'Pejabat Penanda Tangan',
        ];
    }

    private function rules()
    {
        return [
            'instansi'                 => 'required',
            'jabatan'                  => 'required',
            'mulai'                    => 'required',
            'selesai'                  => 'required',
            'gaji_pokok'               => 'required|numeric',
            'sk_nomor'                 => 'required',
            'sk_tanggal'               => 'required',
            'sk_pejabat_penandatangan' => 'required',
        ];
    }
}