<?php

namespace Modules\Download\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Pemberkasan\Entities\Berkas;
use Modules\TabelRefrensi\Entities\DataPeserta;
use ZipArchive;

class DownloadBerkasController extends Controller
{
    public function index()
    {
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

                    $relativePath = 'berkas/' . substr($filePath, strlen($path) + 1);
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
                    $relativePath = $no_peserta . '/' . substr($filePath, strlen($path) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            return response()->download($zip_file);
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', 'Download Gagal!. Berkas tidak ditemukan');
        }
    }
}
