<?php

namespace Modules\DRH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Pendidikan;
use Yajra\DataTables\Facades\DataTables;

class PendidikanController extends Controller
{
    public function index()
    {
        return view('drh::pendidikan.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                Pendidikan::create([
                    'peserta_id'     => session()->get('peserta_id'),
                    'tingkat'        => $request->get('tingkat'),
                    'nama_lembaga'   => $request->get('nama_lembaga'),
                    'tempat_id'      => $request->get('tempat_id'),
                    'akreditasi'     => $request->get('akreditasi'),
                    'gelar_depan'    => $request->get('gelar_depan'),
                    'gelar_belakang' => $request->get('gelar_belakang'),
                    'ijazah_nomor'   => $request->get('ijazah_nomor'),
                    'ijazah_tanggal' => $request->get('ijazah_tanggal'),
                    'ijazah_pejabat' => $request->get('ijazah_pejabat'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah Pendidikan Berhasil!'
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
        $data = Pendidikan::findOrFail($id);
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
                Pendidikan::where('id', $id)->update([
                    'peserta_id'     => session()->get('peserta_id'),
                    'tingkat'        => $request->get('tingkat'),
                    'nama_lembaga'   => $request->get('nama_lembaga'),
                    'tempat_id'      => $request->get('tempat_id'),
                    'akreditasi'     => $request->get('akreditasi'),
                    'gelar_depan'    => $request->get('gelar_depan'),
                    'gelar_belakang' => $request->get('gelar_belakang'),
                    'ijazah_nomor'   => $request->get('ijazah_nomor'),
                    'ijazah_tanggal' => $request->get('ijazah_tanggal'),
                    'ijazah_pejabat' => $request->get('ijazah_pejabat'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Pendidikan Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Pendidikan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data Pendidikan Berhasil!'
            ]);
        }
        else{
            return abort(404);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = Pendidikan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at');
            return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('drh.pendidikan.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>'.
                        '<a href="'.route('drh.pendidikan.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
            })
            ->editColumn('tempat_id', function ($model) {
                return $model->kabupaten->nama;
            })
            ->editColumn('ijazah_tanggal', function ($model) {
                return tanggal($model->ijazah_tanggal);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

        }
        else{
            return dashbord_url();
        }
    }

    private function attributes()
    {
        return [
            'tingkat'        => 'Tingkat',
            'nama_lembaga'   => 'Nama',
            'tempat_id'      => 'Tempat',
            'ijazah_nomor'   => 'Nomor Ijazah',
            'ijazah_tanggal' => 'Tanggal Ijazah',
            'ijazah_pejabat' => 'Pejabatan',
        ];
    }

    private function rules()
    {
        return [
            'tingkat'        => 'required',
            'nama_lembaga'   => 'required',
            'tempat_id'      => 'required',
            'ijazah_nomor'   => 'required',
            'ijazah_tanggal' => 'required',
            'ijazah_pejabat' => 'required',
        ];
    }
}
