<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Pelatihan;
use Yajra\DataTables\Facades\DataTables;

class PelatihanController extends Controller
{
    public function index()
    {
        return view('drh::pelatihan.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Pelatihan::create([
                    'peserta_id'              => session()->get('peserta_id'),
                    'nama_pelatihan'          => $request->get('nama_pelatihan'),
                    'mulai'                   => $request->get('mulai'),
                    'selesai'                 => $request->get('selesai'),
                    'nomor'                   => $request->get('nomor'),
                    'tempat'                  => $request->get('tempat'),
                    'institusi_penyelenggara' => $request->get('institusi_penyelenggara'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Pelatihan Berhasil!'
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
        $data = Pelatihan::findOrFail($id);
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
                Pelatihan::where('id', $id)->update([
                    'nama_pelatihan'          => $request->get('nama_pelatihan'),
                    'mulai'                   => $request->get('mulai'),
                    'selesai'                 => $request->get('selesai'),
                    'nomor'                   => $request->get('nomor'),
                    'tempat'                  => $request->get('tempat'),
                    'institusi_penyelenggara' => $request->get('institusi_penyelenggara'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Pelatihan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Pelatihan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Pelatihan Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Pelatihan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.pelatihan.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.pelatihan.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
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
            'nama_pelatihan'          => 'Nama Pelatihan',
            'mulai'                   => 'Mulai',
            'selesai'                 => 'Selesai',
            'nomor'                   => 'Nomor',
            'tempat'                  => 'Tempat',
            'institusi_penyelenggara' => 'Institusi Penyelenggara',
        ];
    }

    private function rules()
    {
        return [
            'nama_pelatihan'          => 'required',
            'mulai'                   => 'required',
            'selesai'                 => 'required',
            'nomor'                   => 'required',
            'tempat'                  => 'required',
            'institusi_penyelenggara' => 'required',
        ];
    }
}