<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Penghargaan;
use Yajra\DataTables\Facades\DataTables;

class PenghargaanController extends Controller
{
    public function index()
    {
        return view('drh::penghargaan.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Penghargaan::create([
                    'peserta_id'       => session()->get('peserta_id'),
                    'nama'             => $request->get('nama'),
                    'sk_nomor'         => $request->get('sk_nomor'),
                    'sk_tanggal'       => $request->get('sk_tanggal'),
                    'tahun_perolehan'  => $request->get('tahun_perolehan'),
                    'instansi_pemberi' => $request->get('instansi_pemberi'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Penghargaan Berhasil!'
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
        $data = Penghargaan::findOrFail($id);
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
                Penghargaan::where('id', $id)->update([
                    'nama'             => $request->get('nama'),
                    'sk_nomor'         => $request->get('sk_nomor'),
                    'sk_tanggal'       => $request->get('sk_tanggal'),
                    'tahun_perolehan'  => $request->get('tahun_perolehan'),
                    'instansi_pemberi' => $request->get('instansi_pemberi'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Penghargaan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Penghargaan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Penghargaan Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Penghargaan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.penghargaan.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.penghargaan.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('sk_tanggal', function ($model) {
                return tanggal($model->sk_tanggal);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'nama'             => 'Nama',
            'sk_nomor'         => 'No. SK',
            'sk_tanggal'       => 'Tanggal SK',
            'tahun_perolehan'  => 'Tahun Perolehan',
            'instansi_pemberi' => 'Instansi Pemberi',
        ];
    }

    private function rules()
    {
        return [
            'nama'             => 'required',
            'sk_nomor'         => 'required',
            'sk_tanggal'       => 'required',
            'tahun_perolehan'  => 'required|numeric',
            'instansi_pemberi' => 'required',
        ];
    }
}