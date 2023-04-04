<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User_Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permission = Permission::all();
        return view('table_view.role', compact('roles', 'permission'));
    }
    public function get_roles($id)
    {
        try {
            $roles = Role::all();
            $countRoles = count($roles);
            $user_info = DB::table('user as u')->select(
                'p.person_name',
                'p.person_surname',
                'u.user_id',
            )
                ->join('person as p', 'u.person_id', '=', 'p.person_id')
                ->where('u.user_id', $id)->first();
            $fill = DB::table('user_role as ur')->select(
                'ur.id',
                'p.person_name',
                'ur.ur_state',
                'ur.user_id',
                'r.role_id as role_id',
                'r.role_description as role_description'
            )
                ->join('role as r', 'ur.role_id', '=', 'r.role_id')
                ->join('user as u', 'ur.user_id', '=', 'u.user_id')
                ->join('person as p', 'p.person_id', '=', 'u.person_id')
                ->where('ur.user_id', $id)->get();

            $countFill = count($fill);
            if ($countFill == $countRoles) {
                $addRoleBtnState = 0;
            } else {
                $addRoleBtnState = 1;
            }
            // print_r($fill);
            // print_r('-----------------------------------------------');
            // print_r($addRoleBtnState);
            // exit();
            return view('layout.role_table', compact('user_info', 'fill', 'addRoleBtnState'));
        } catch (\Exception $e) {
            $user_info = DB::table('user as u')->select(
                'p.person_name',
                'p.person_surname',
                'u.user_id',
            )
                ->join('person as p', 'u.person_id', '=', 'p.person_id')
                ->where('u.user_id', $id)->first();
            $fill = [];
            // print_r($fill);
            // exit();
            return view('layout.role_table', compact('user_info', 'fill'));
        }
    }
    public function change($ur_id)
    {
        $user_id = request('user_id');
        $state = request('state');

        $data = User_Role::find($ur_id);
        $data->ur_state = $state;
        $data->update();

        $getdata = $this->get_roles($user_id);
        return response($getdata);
    }

    //start section en proceso
    public function show_add_role()
    {
        try {
            $user_id = request('user_id');
            $user_info = DB::table('user as u')->select(
                'p.person_name',
                'u.user_id as user_id'
            )
                ->join('person as p', 'u.person_id', '=', 'p.person_id')
                ->where('u.user_id', $user_id)->first();

            $rolelist = Role::whereNotIn('role_id', function ($query) {
                $query->select('role_id')->from('user_role')->where('user_id', request('user_id'));
            })->get();
            return view('layout.add_role', compact('user_info', 'rolelist'));
        } catch (\Exception $e) {
            $user_id = request('user_id');
            $user_info = DB::table('user as u')->select(
                'p.person_name',
                'u.user_id as user_id'
            )
                ->join('person as p', 'u.person_id', '=', 'p.person_id')
                ->where('u.user_id', $user_id)->first();
            $rolelist = DB::table('role')
                ->select('role_id', 'role_description')
                ->orderBy('r.role_id')->get();
            // echo($rolelist);
            // exit();
            return view('layout.add_role', compact('user_info', 'rolelist'));
        }
    }
    public function add_role(Request $request)
    {
        $record = $request->input('role');
        $user_id = $request->input('user_id');
        $record_lenght = count($record);

        for ($index = 0; $index < $record_lenght; $index++) {
            if (isset($record[$index])) {
                $row = new User_Role();
                $row->user_id = $user_id;
                $row->role_id = $request->input("role.{$index}");
                // print_r('**fila: ');
                // print_r(' *usuario: ');
                // print_r($row->user_id);
                // print_r(' *Role: ');
                // print_r($row->role_id);
                // print_r($record);
                $row->save();
            }
        }
        // exit();
        // $showdata = $this->get_roles($user_id);
        // return response($showdata);
        // $getdata = $this->get_roles($user_id);
        return redirect()->back()->with('status', 'success');
    }
}
