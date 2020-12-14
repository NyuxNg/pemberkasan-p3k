<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\KeteranganLainnya;
use Yajra\DataTables\Facades\DataTables;

class KeteranganLainnyaController extends Controller
{
    public function index()
    {
        return view('drh::lainnya.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                KeteranganLainnya::create([
                    'peserta_id' => session()->get('peserta_id'),
                    'nama'       => $request->get('nama'),
                    'nomor'      => $request->get('nomor'),
                    'tanggal'    => $request->get('tanggal'),
                    'pejabat'    => $request->get('pejabat'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Keterangan Lainnya Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'errors'  =>true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    public function edit($id)
    {
        $data = KeteranganLainnya::findOrFail($id);
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
                KeteranganLainnya::where('id', $id)->update([
                    'nama'       => $request->get('nama'),
                    'nomor'      => $request->get('nomor'),
                    'tanggal'    => $request->get('tanggal'),
                    'pejabat'    => $request->get('pejabat'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Keterangan Lainnya Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'errors'  =>true,
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = KeteranganLainnya::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Keterangan Lainnya Berhasil!'
            ]);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = KeteranganLainnya::where('peserta_id', session()->get('peserta_id'))->orderBy('nama');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.lainnya.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.lainnya.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('nama', function ($model) {
                $nama = array(
                        'a. skck'       => 'Surat Keterangan Catatan Kepolisian', 
                        'b. sks_jasroh' => 'Surat Keterangan Sehat Jasmani dan Rohani', 
                        'c. skb_napza'  => 'Surat Keterangan Bebas NAPZA', 
                        'd. lainnya'    => 'Keterangan Lainnya', 
                    );
                return $nama[$model->nama];
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    private function attributes()
    {
        return [
            'nama'    => 'Nama Keterangan',
            'nomor'   => 'Nomor',
            'tanggal' => 'Tanggal',
            'pejabat' => 'Pejabat',
        ];
    }

    private function rules()
    {
        return [
            'nama'    => 'required',
            'nomor'   => 'required',
            'tanggal' => 'required',
            'pejabat' => 'required',
        ];
    }
}
