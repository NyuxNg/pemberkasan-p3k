<?php

namespace Modules\GetData\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class GetDataController extends Controller
{
    public function roles(Request $request)
    {
        if ($request->ajax()) {
            $data = array(
                'success' => true,
                'content' => Role::whereIn('name',['admin', 'verifikator'])->orderBy('description')->get(), 
            );
            return response()->json($data);
        }
        else{
            return redirect()->route('dashboard.index');
        }
    }
}
