<?php

namespace Modules\UserManajemen\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserPanitaController extends Controller
{
    public function index()
    {
        return view('usermanajemen::panitia.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate($this->rules(), [], $this->attributes());
            try {
                $role = Role::find($request->get('role'));
                $user = User::create([
                    'name'     => $request->get('name'),
                    'username' => $request->get('username'),
                    'email'    => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);

                $user->assignRole($role->name);

                return response()->json([
                    'success' => true,
                    'message' => 'Tambah User Berhasil!'
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage(), 422);
            }
        }
        else{
            return dashbord_url();
        }
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $data['role'] = Role::whereName($data->getRoleNames()[0])->first();
        return response()->json([
            'success' => true,
            'content' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $role = Role::find($request->get('role'));

            if (!empty($request->get('password'))) {
                $rules = [
                    'name'     => 'required',
                    'username' => 'required',
                    'email'    => 'required',
                    'password' => 'required|confirmed',
                ];

                $attributes = [
                    'name'     => 'Nama',
                    'username' => 'Username',
                    'email'    => 'E-Mail',
                    'password' => 'Password',
                ];

                $request->validate($rules, [], $attributes);

                try {
                    User::where('id', $id)->update([
                        'name'          => $request->get('name'),
                        'username'      => $request->get('username'),
                        'email'         => $request->get('email'),
                        'password'      => Hash::make($request->get('password')),
                    ]);

                    $user = User::find($id);
                    $user->syncRoles($role->name);

                } catch (\Exception $e) {
                    $getMessage = $e->getMessage();
                    $exp        = explode("'", $getMessage);
                    if ($exp[3] == "users_username_unique") {
                        $message = [
                            'message' => $exp[0],
                            'errors' => [
                                'username' => "Username sudah digunakan!"
                            ],
                        ];
                    }
                    elseif ($exp[3] == "users_email_unique") {
                        $message = [
                            'message' => $exp[0],
                            'errors' => [
                                'email' => "E-Mail sudah digunakan!"
                            ],
                        ];
                    }
                    else{
                        $message = [
                            'message' => $exp[0],
                        ];
                    }
                    return response()->json($message, 422);
                }
                
            }
            else{
                $rules = [
                    'name'     => 'required',
                    'username' => 'required',
                    'email'    => 'required',
                ];

                $attributes = [
                    'name'     => 'Nama',
                    'username' => 'Username',
                    'email'    => 'E-Mail',
                ];

                $request->validate($rules, [], $attributes);
                
                try {
                    User::where('id', $id)->update([
                        'name'          => $request->get('name'),
                        'username'      => $request->get('username'),
                        'email'         => $request->get('email'),
                    ]);

                    $user = User::find($id);
                    $user->syncRoles($role->name);

                } catch (\Exception $e) {
                    $getMessage = $e->getMessage();
                    return $getMessage;
                    $exp        = explode("'", $getMessage);
                    if ($exp[3] == "users_username_unique") {
                        $message = [
                            'message' => $exp[0],
                            'errors' => [
                                'username' => "Username sudah digunakan!"
                            ],
                        ];
                    }
                    elseif ($exp[3] == "users_email_unique") {
                        $message = [
                            'message' => $exp[0],
                            'errors' => [
                                'email' => "E-Mail sudah digunakan!"
                            ],
                        ];
                    }
                    else{
                        $message = [
                            'message' => $exp[0],
                        ];
                    }
                    return response()->json($message, 422);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Update User Berhasil!'
            ]);
        }
        else{
            return dashbord_url();
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = User::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hapus Data User Berhasil!'
            ]);
        }
        else{
            return abort(404);
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model  =   DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('users.id', '<>', Auth::id())
                ->whereIn('roles.name', ['admin', 'verifikator'])
                ->select('users.*', 'roles.description');

            return DataTables::of($model)
            ->filterColumn('description', function($query, $keyword) {
                $query->orWhere('roles.description', 'like', ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return  '<a href="'.route('userman.panitia.edit', $model->id).'" class="btn btn-warning text-dark btn-sm btn-edit"><i class="fa fa-pencil-square mr-1"></i> Edit</a>';
                // '<a href="'.route('userman.panitia.destroy', $model->id).'" class="btn btn-danger btn-sm btn-delete ml-2"><i class="fa fa-remove mr-1"></i> Hapus</a>';
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
            'name'     => 'Nama',
            'username' => 'Username',
            'email'    => 'E-Mail',
            'password' => 'Password',
            'role'     => 'Role',
        ];
    }

    private function rules()
    {
        return [
            'name'     => 'required',
            'username' => 'required|unique:users',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed',
            'role'     => 'required',
        ];
    }
}
