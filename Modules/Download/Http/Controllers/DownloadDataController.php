<?php

namespace Modules\Download\Http\Controllers;

use App\Exports\Download\KontakPesertaExport;
use App\Exports\Download\LainnyaPesertaExport;
use App\Exports\Download\PesertaExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DownloadDataController extends Controller
{
    public function index()
    {
        return view('download::data.index');
    }

    public function peserta(Request $request)
    {
        return Excel::download(new PesertaExport, "DataPeserta.xlsx");
    }

    public function kontak(Request $request)
    {
        return Excel::download(new KontakPesertaExport, "KontakPeserta.xlsx");
    }

    public function lainnya(Request $request)
    {
        return Excel::download(new LainnyaPesertaExport, "DataLainnya.xlsx");
    }
}
