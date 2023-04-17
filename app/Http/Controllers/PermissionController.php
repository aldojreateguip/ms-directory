<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $user_auth = Auth::user();
        if (!$user_auth) {
            return redirect()->intended('/');
        } else {
            return view('user_view.main');
        }
    }
    public function show()
    {
        $role_description = request('role_description');

        $role = DB::table('role')
            ->where('role_description', $role_description)
            ->first();

        if (empty($role)) {
            $permissions = Permission::all();
        } else {
            $role_id = $role->role_id;
            $permissions = DB::table('permission as p')
                ->select('p.*')
                ->whereNotIn('p.permission_id', function ($query) use ($role_id) {
                    $query->select('permission_id')
                        ->from('role_permission')
                        ->where('role_id', '=', $role_id);
                })
                ->get();
        }
        return view('layout.show_permission_list', compact('permissions'));
    }
    public function update_permission()
    {
    }
    public function asign_permission()
    {
    }
}
