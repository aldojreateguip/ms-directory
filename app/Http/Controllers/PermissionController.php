<?php

namespace App\Http\Controllers;

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
    public function add_permission(){
        
    }
    public function update_permission(){

    }
    public function asign_permission(){

    }
}
