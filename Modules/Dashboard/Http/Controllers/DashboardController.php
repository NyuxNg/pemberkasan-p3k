<?php

namespace Modules\Dashboard\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;

class DashboardController extends Controller
{
    public function index()
    {
    	$role = session()->get('role');
    	switch ($role) {
    		case 'admin':
        		return $this->admin();
    			break;

    		case 'verifikator':
        		return $this->verifikator();
    			break;
    		default:
        		return $this->peserta();
    			break;
    	}
    }

    private function peserta()
    {
    	$data = array(
			'login'   => Auth::user(), 
			'peserta' => DataPeserta::find(session()->get('peserta_id')), 
    	);
        return view('dashboard::index', $data);
    }

    private function admin()
    {
    	$data = array(
			'user_aktif'      => User::all()->count(), 
			'peserta'         => DataPeserta::all()->count(), 
			'berkas'          => Berkas::whereNotNull('file')->get()->count(), 
			'berkas_diterima' => Berkas::whereNotNull('file')->where('status', 'Diterima')->get()->count(), 
			'berkas_ditolak'  => Berkas::whereNotNull('file')->where('status', 'Ditolak')->get()->count(), 
			'berkas_proses'   => Berkas::whereNotNull('file')->where('status', 'Proses')->get()->count(), 
    	);
        return view('dashboard::admin', $data);
    }

    private function verifikator()
    {
    	$data = array(
			'peserta'         => DataPeserta::all()->count(), 
			'berkas'          => Berkas::whereNotNull('file')->get()->count(), 
			'berkas_diterima' => Berkas::whereNotNull('file')->where('status', 'Diterima')->get()->count(), 
			'berkas_ditolak'  => Berkas::whereNotNull('file')->where('status', 'Ditolak')->get()->count(), 
			'berkas_proses'   => Berkas::whereNotNull('file')->where('status', 'Proses')->get()->count(), 
    	);
        return view('dashboard::verifikator', $data);
    }
}
