<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Organisasi;
use Yajra\DataTables\Facades\DataTables;

class OrganisasiController extends Controller
{
    public function index()
    {
        return view('drh::organisasi.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Organisasi::create([
                    'peserta_id' => session()->get('peserta_id'),
                    'nama'       => $request->get('nama'),
                    'jabatan'    => $request->get('jabatan'),
                    'mulai'      => $request->get('mulai'),
                    'selesai'    => $request->get('selesai'),
                    'tempat'     => $request->get('tempat'),
                    'pimpinan'   => $request->get('pimpinan'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Organisasi Berhasil!'
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
        $data = Organisasi::findOrFail($id);
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
                Organisasi::where('id', $id)->update([
                    'nama'       => $request->get('nama'),
                    'jabatan'    => $request->get('jabatan'),
                    'mulai'      => $request->get('mulai'),
                    'selesai'    => $request->get('selesai'),
                    'tempat'     => $request->get('tempat'),
                    'pimpinan'   => $request->get('pimpinan'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Organisasi Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Organisasi::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Organisasi Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Organisasi::where('peserta_id', session()->get('peserta_id'))->orderBy('nama');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.organisasi.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.organisasi.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('mulai', function ($model) {
                return tanggal($model->mulai);
            })
            ->editColumn('selesai', function ($model) {
                return tanggal($model->selesai);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'nama'     => 'Nama Organisasi',
            'jabatan'  => 'Jabatan',
            'mulai'    => 'Mulai',
            'selesai'  => 'Selesai',
            'tempat'   => 'Alamat Kantor',
            'pimpinan' => 'Pimpinan',
        ];
    }

    private function rules()
    {
        return [
            'nama'     => 'required',
            'jabatan'  => 'required',
            'mulai'    => 'required',
            'selesai'  => 'required',
            'tempat'   => 'required',
            'pimpinan' => 'required',
        ];
    }
}
