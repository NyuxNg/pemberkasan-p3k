<?php

namespace Modules\DataPerorangan\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\DataPerorangan\Entities\DataKontak;
use Modules\TabelRefrensi\Entities\DataPeserta;

class DataKontakController extends Controller
{
    public function index()
    {
        $kontak = DataKontak::where('peserta_id', session()->get('peserta_id'))->first();
        if (is_null($kontak)) {
            DataKontak::create([
                'peserta_id' => session()->get('peserta_id'),
            ]);
        }
        $data = array(
            'kontak' => DataKontak::where('peserta_id', session()->get('peserta_id'))->first()
        );
        return view('dataperorangan::data-kontak.index', $data);
    }


    public function store(Request $request)
    {
        DataKontak::updateOrCreate(
            [
                'peserta_id' => session()->get('peserta_id'),
            ],
            [
                'peserta_id' => session()->get('peserta_id'),
                'no_hp'      => $request->get('no_hp'),
                'email'      => $request->get('email'),
                'alamat'     => $request->get('alamat'),
            ]
        );

        User::where('username', Auth::user()->username)->update([
            'email'      => $request->get('email'),
        ]);

        return redirect()->back()->with('success', 'Update Data Kontak Berhasil');
    }
}
