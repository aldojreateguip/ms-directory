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
use Symfony\Component\Console\Completion\Output\ZshCompletionOutput;

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

    public function store(Request $request)
    {
        $request->validate([
            'apassword' => 'required',
            'apersonid' => 'required',
        ]);

        $person = DB::table('person')->select('person_email')->where('person_id', '=', $request->apersonid)->first();

        $data = new User();
        $data->email = $person->person_email;
        $data->password = Hash::make($request->input('apassword'));
        $data->person_id = $request->input('apersonid');
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
