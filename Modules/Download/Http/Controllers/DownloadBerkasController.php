<?php

namespace Modules\Download\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DRH\Entities\Anak;
use Modules\DRH\Entities\KeteranganLainnya;
use Modules\DRH\Entities\KeteranganPerorangan;
use Modules\DRH\Entities\Mertua;
use Modules\DRH\Entities\OrangTua;
use Modules\DRH\Entities\Organisasi;
use Modules\DRH\Entities\Pasangan;
use Modules\DRH\Entities\Pekerjaan;
use Modules\DRH\Entities\Pelatihan;
use Modules\DRH\Entities\Pendidikan;
use Modules\DRH\Entities\Penghargaan;
use Modules\DRH\Entities\Saudara;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;
use ZipArchive;

class DownloadBerkasController extends Controller
{
    public function index()
    {
        if (session()->get('role') == 'peserta') {
            return view('download::berkas.index_peserta');
        }
        else{
            $berkas = Berkas::whereNotNull('file')->select('peserta_id')->groupBy('peserta_id')->get();
            $id = [];
            foreach ($berkas as $b) {
                $id[] = $b->peserta_id;
            }
            $data = array(
                'pesertas' => DataPeserta::whereIn('id', $id)->orderBy('nama')->get(), 
            );
            return view('download::berkas.index', $data);
        }
    }

    public function all(Request $request)
    {
        try {
            $zip_file = 'berkas.zip';
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $path = public_path('upload/berkas/');
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file)
            {
                if (!$file->isDir()) {
                    $filePath     = $file->getRealPath();

                    $relativePath = 'berkas/' . substr($filePath, strlen($path));
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zip_file);
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Download Gagal!. Berkas tidak ditemukan');
        }
    }

    public function peserta(Request $request, $id)
    {
        try {
            $peserta    = DataPeserta::find($id);
            $no_peserta = $peserta->no_peserta;
            $zip_file   = $no_peserta .'.zip';
            $zip        = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $path = public_path('upload/berkas') . "/" . $no_peserta . "/";
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file)
            {
                if (!$file->isDir()) {
                    $filePath     = $file->getRealPath();
                    $relativePath = $no_peserta . '/' . substr($filePath, strlen($path));
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zip_file);
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Download Gagal!. Berkas tidak ditemukan');
        }
    }

    public function suratPernyataan()
    {
        $data = KeteranganPerorangan::where('peserta_id', session()->get('peserta_id'))->select('nama', 'tempat_lahir_id', 'tanggal_lahir', 'agama', 'jalan', 'kecamatan_id')->first();
        
        if (isset($data)) {
            $peserta = array(
                'nama'      => ucwords(strtolower($data->nama)), 
                'ttl'       => ucwords(strtolower($data->tempat_lahir->nama)) .", ". tanggal($data->tanggal_lahir), 
                'agama'     => $data->agama, 
                'jalan'     => $data->jalan, 
                'kecamatan' => ucwords(strtolower($data->kecamatan->nama)), 
            );
            $pdf = PDF::loadview('download::berkas.surat-pernyataan', compact('peserta'));
            return $pdf->download('Surat Pernyataan.pdf');
        } else {
            return redirect()->back()->with('gagal', 'Download Gagal!. Anda belum mengisi data DRH - Keterangan Perorangan');
        }
        
    }

    public function drhPerorangan()
    {
        $peserta    =   KeteranganPerorangan::where('peserta_id', session()->get('peserta_id'))->first();
        $berkas     =   Berkas::join('tabref_jenis_berkas', 'tabref_jenis_berkas.id', '=', 'pemberkasan_berkas.jberkas_id')
                        ->join('tabref_data_peserta', 'tabref_data_peserta.id', '=', 'pemberkasan_berkas.peserta_id')
                        ->where('tabref_jenis_berkas.kode', 'FOTOP3K')
                        ->select('pemberkasan_berkas.*', 'tabref_data_peserta.no_peserta')->first();
        if (isset($peserta)) {
            $data = array(
                'peserta' => $peserta, 
                'berkas'  => $berkas, 
            );
            $pdf = PDF::loadview('download::berkas.drh-perorangan', $data);
            return $pdf->download('DRH Perorangan.pdf');
        } else {
            return redirect()->back()->with('gagal', 'Download Gagal!. Anda belum mengisi data DRH - Keterangan Perorangan');
        }
    }

    public function drhRiwayat ()
    {
        $data = array(
            'pendidikan'  => Pendidikan::where('peserta_id', session()->get('peserta_id'))->orderBy('created_at')->get(),
            'pelatihan'   => Pelatihan::where('peserta_id', session()->get('peserta_id'))->orderBy('mulai')->get(),
            'pekerjaan'   => Pekerjaan::where('peserta_id', session()->get('peserta_id'))->orderBy('mulai')->get(),
            'penghargaan' => Penghargaan::where('peserta_id', session()->get('peserta_id'))->orderBy('sk_tanggal')->get(),
            'pasangan'    => Pasangan::where('peserta_id', session()->get('peserta_id'))->orderBy('nik')->get(),
            'anak'        => Anak::where('peserta_id', session()->get('peserta_id'))->orderBy('nik')->get(),
            'orangtua'    => OrangTua::where('peserta_id', session()->get('peserta_id'))->orderBy('nik')->get(),
            'saudara'     => Saudara::where('peserta_id', session()->get('peserta_id'))->orderBy('nik')->get(),
            'mertua'      => Mertua::where('peserta_id', session()->get('peserta_id'))->orderBy('nik')->get(),
            'organisasi'  => Organisasi::where('peserta_id', session()->get('peserta_id'))->orderBy('mulai')->get(),
            'lainnya'     => KeteranganLainnya::where('peserta_id', session()->get('peserta_id'))->orderBy('nama')->get(),
            'peserta'     => KeteranganPerorangan::where('peserta_id', session()->get('peserta_id'))->first()
        );
        $pdf = PDF::setPaper('a4', 'landscape')->loadview('download::berkas.drh-riwayat', $data);
        return $pdf->download('DRH Perorangan.pdf');
    }
}
