<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('person')->select(
            'person_id',
            'person_name',
            'person_surname',
        )->orderBy('person_surname', 'asc')
        ->get();
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
    public function find($id)
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
        $data->record_state = 0;
        $data->user_state = 0;
        $data->update();
        return response()->json(['status' => 'success']);
    }
    public function reset($id)
    {
        $password = DB::table('person as p')
            ->select('p.person_identity_document as iddoc')
            ->join('user as u', 'p.person_id', '=', 'u.person_id')
            ->where('u.user_id', $id)
            ->first();

        $data = User::find($id);
        $data->password = Hash::make($password->iddoc);
        $data->update();
        return response()->json(['status' => 'success']);
    }
    public function get_user_dttable()
    {
        return datatables()->query(
            DB::table('user')
                ->join('person as p', 'p.person_id', '=', 'user.person_id')
                ->select('user.record_state', 'user.email', 'user.user_state', 'user.user_id', 'p.person_name', 'p.person_surname')
                ->orderBy('user.user_id', 'asc')
        )->toJson();
    }
    public function change_state($id)
    {
        $state = request('state');

        $data = User::find($id);
        $data->user_state = $state;
        $data->update();
        return response()->json(['status' => 'success']);
    }
}
