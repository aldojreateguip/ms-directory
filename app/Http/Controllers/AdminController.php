<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $user_auth = Auth::user();
        if (!$user_auth) {
            return redirect()->intended('/');
        }else{
            return view('user_view.main');
        }
    }
}
