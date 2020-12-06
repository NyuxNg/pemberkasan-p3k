<?php

namespace Modules\UserManajemen\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('usermanajemen::profile.index');
    }

    public function ganti(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed',
        ];

        $attributes = [
            'password' => 'Password',
        ];

        $request->validate($rules, [], $attributes);
        User::where('id', Auth::id())->update([
            'password'      => Hash::make($request->get('password')),
        ]);
        return redirect()->back()->with('success', 'Password Berhasil Diganti');

    }
}
