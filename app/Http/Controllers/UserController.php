<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('user as u')->select(
            'p.person_name',
            'p.person_surname',
            'u.user_state',
            'u.user_id',
        )
            ->join('person as p', 'u.person_id', '=', 'p.person_id')->get();
        return view('table_view.user', compact('data'));
    }

    public function get_roles($id)
    {
        try {
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
                'ur.state',
                'ur.user_id',
                'r.role_id as role_id',
                'r.role_description as role_description'
            )
                ->join('role as r', 'ur.role_id', '=', 'r.role_id')
                ->join('user as u', 'ur.user_id', '=', 'u.user_id')
                ->join('person as p', 'p.person_id', '=', 'u.person_id')
                ->where('ur.user_id', $id)->get();
            // print_r($fill);
            // print_r('-----------------------------------------------');
            // print_r($user_info);
            // exit();
            return view('layout.role_table', compact('fill', 'user_info'));
        } catch (\Exception $e) {

            $person = DB::table('user as u')
                ->select(
                    'p.person_name as name',
                    'u.user_id'
                )
                ->join('person as p', 'u.person_id', '=', 'p.person_id')
                ->where('u.user_id', $id)->first();
            // foreach($person as $person){
            //     echo ($person);
            // }
            // exit();
            return view('layout.role_table', compact('person'));
        }
    }
    public function change($ur_id)
    {
        $user_id = request('user_id');
        $state = request('state');

        $data = User_Role::find($ur_id);
        $data->state = $state;
        $data->update();

        $getdata = $this->get_roles($user_id);
        return response($getdata);
    }

    //start section en proceso
    public function show_add_role()
    {
        $user_id = request('user_id');
        $user_info = DB::table('user as u')->select(
            'p.person_name',
        )
            ->join('person as p', 'u.person_id', '=', 'p.person_id')
            ->where('u.user_id', $user_id)->first();
        $rolelist = DB::table('role as r')
            ->select('r.role_id', 'r.role_description')
            ->leftJoin('user_role as ur', 'r.role_id', '=', 'ur.role_id')
            ->whereNull('ur.role_id')->orderBy('r.role_id')->get();
        // echo($rolelist);
        // exit();
        return view('layout.add_role', compact('user_info', 'rolelist'));
    }
    public function add_role()
    {
    }
    //endsection en proceso

    public function store(Request $request)
    {
        $request->validate([
            'apassword' => 'required',
            'astate' => 'required',
            'apersonid' => 'required',
            'aroleid' => 'required',
        ]);

        $person = DB::table('person')->select('person_email')->where('person_id', '=', $request->apersonid)->first();

        $data = new User();
        $data->email = $person->person_email;
        $data->password = Hash::make($request->input('apassword'));
        $data->user_state = $request->input('astate');
        $data->person_id = $request->input('apersonid');
        $data->role_id = $request->input('aroleid');
        $data->save();
        return redirect()->back()->with('status', 'Registro Añadido Exitosamente.');
    }
    public function edit($id)
    {
        $data = User::find($id);
        return response()->json(['user' => $data]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'upassword' => 'required',
            'ustate' => 'required',
            'upersonid' => 'required',
        ]);
        $id = $request->input('record_id');
        $data = User::find($id);
        $data->password = Hash::make($request->input('upassword'));
        $data->user_state = $request->input('ustate');
        $data->person_id = $request->input('upersonid');
        $data->update();
        return redirect()->back()->with('status', 'Registro Actualizado Exitosamente.');
    }

    public function delete($id)
    {
        $user_role = DB::table('user_role')->where('user_id', $id)->get();
        foreach ($user_role as $role) {
            DB::table('user_role')->where('id', $role->id)->delete();
        }
        $data = User::find($id);
        $data->delete();
        return response()->json(['status', 'welcome']);
    }
}
