<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Pasangan;
use Yajra\DataTables\Facades\DataTables;

class PasanganController extends Controller
{
    public function index()
    {
        return view('drh::pasangan.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Pasangan::create([
                    'peserta_id'         => session()->get('peserta_id'),
                    'nik'                => $request->get('nik'),
                    'nip'                => $request->get('nip'),
                    'nama'               => $request->get('nama'),
                    'tempat_lahir_id'    => $request->get('tempat_lahir_id'),
                    'tanggal_lahir'      => $request->get('tanggal_lahir'),
                    'pekerjaan'          => $request->get('pekerjaan'),
                    'pekerjaan_tempat'   => $request->get('pekerjaan_tempat'),
                    'status_pernikahan'  => $request->get('status_pernikahan'),
                    'akte_nikah_nomor'   => $request->get('akte_nikah_nomor'),
                    'akte_nikah_tanggal' => $request->get('akte_nikah_tanggal'),
                    'status_hidup'       => $request->get('status_hidup'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Pasangan Berhasil!'
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
        $data = Pasangan::findOrFail($id);
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
                Pasangan::where('id', $id)->update([
                    'nik'                => $request->get('nik'),
                    'nip'                => $request->get('nip'),
                    'nama'               => $request->get('nama'),
                    'tempat_lahir_id'    => $request->get('tempat_lahir_id'),
                    'tanggal_lahir'      => $request->get('tanggal_lahir'),
                    'pekerjaan'          => $request->get('pekerjaan'),
                    'pekerjaan_tempat'   => $request->get('pekerjaan_tempat'),
                    'status_pernikahan'  => $request->get('status_pernikahan'),
                    'akte_nikah_nomor'   => $request->get('akte_nikah_nomor'),
                    'akte_nikah_tanggal' => $request->get('akte_nikah_tanggal'),
                    'status_hidup'       => $request->get('status_hidup'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Pasangan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Pasangan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Pasangan Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Pasangan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.pasangan.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.pasangan.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('tempat_lahir_id', function ($model) {
                return $model->kabupaten->nama;
            })
            ->editColumn('tanggal_lahir', function ($model) {
                return $model->kabupaten->nama . ', ' . tanggal($model->tanggal_lahir);
            })
            ->editColumn('akte_nikah_tanggal', function ($model) {
                return tanggal($model->akte_nikah_tanggal);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'nik'                => 'NIK',
            'nama'               => 'Nama',
            'tempat_lahir_id'    => 'Tempat Lahir',
            'tanggal_lahir'      => 'Tanggal Lahir',
            'status_pernikahan'  => 'Status Pernikahan',
            'akte_nikah_nomor'   => 'No. Akte Pernikahan',
            'akte_nikah_tanggal' => 'Tanggal Pernikahan',
            'status_hidup'       => 'Status Hidup',
        ];
    }

    private function rules()
    {
        return [
            'nik'                => 'required|numeric',
            'nama'               => 'required',
            'tempat_lahir_id'    => 'required',
            'tanggal_lahir'      => 'required',
            'status_pernikahan'  => 'required',
            'akte_nikah_nomor'   => 'required',
            'akte_nikah_tanggal' => 'required',
            'status_hidup'       => 'required',
        ];
    }
}