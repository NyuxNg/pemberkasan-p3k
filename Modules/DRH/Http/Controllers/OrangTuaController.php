<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\OrangTua;
use Yajra\DataTables\Facades\DataTables;

class OrangTuaController extends Controller
{
    public function index()
    {
        return view('drh::orang-tua.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                OrangTua::create([
                    'peserta_id'       => session()->get('peserta_id'),
                    'nik'              => $request->get('nik'),
                    'nip'              => $request->get('nip'),
                    'nama'             => $request->get('nama'),
                    'tempat_lahir_id'  => $request->get('tempat_lahir_id'),
                    'tanggal_lahir'    => $request->get('tanggal_lahir'),
                    'pekerjaan'        => $request->get('pekerjaan'),
                    'pekerjaan_tempat' => $request->get('pekerjaan_tempat'),
                    'status_hidup'     => $request->get('status_hidup'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah OrangTua Berhasil!'
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
        $data = OrangTua::findOrFail($id);
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
                OrangTua::where('id', $id)->update([
                    'nik'              => $request->get('nik'),
                    'nip'              => $request->get('nip'),
                    'nama'             => $request->get('nama'),
                    'tempat_lahir_id'  => $request->get('tempat_lahir_id'),
                    'tanggal_lahir'    => $request->get('tanggal_lahir'),
                    'pekerjaan'        => $request->get('pekerjaan'),
                    'pekerjaan_tempat' => $request->get('pekerjaan_tempat'),
                    'status_hidup'     => $request->get('status_hidup'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update OrangTua Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = OrangTua::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data OrangTua Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = OrangTua::where('peserta_id', session()->get('peserta_id'))->orderBy('tanggal_lahir');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.orang-tua.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.orang-tua.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('tempat_lahir_id', function ($model) {
                return $model->kabupaten->nama;
            })
            ->editColumn('tanggal_lahir', function ($model) {
                return $model->kabupaten->nama . ', ' . tanggal($model->tanggal_lahir);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'nik'             => 'NIK',
            'nama'            => 'Nama',
            'tempat_lahir_id' => 'Tempat Lahir',
            'tanggal_lahir'   => 'Tanggal Lahir',
            'status_hidup'    => 'Status Hidup',
        ];
    }

    private function rules()
    {
        return [
            'nik'                => 'required|numeric',
            'nama'               => 'required',
            'tempat_lahir_id'    => 'required',
            'tanggal_lahir'      => 'required',
            'status_hidup'       => 'required',
        ];
    }
}