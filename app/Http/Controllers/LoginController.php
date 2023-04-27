<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{
    public function show()
    {
        $user_auth = Auth::user();
        if (!$user_auth) {
            return view('login_view.login');
        } else {
            return redirect()->back();
        }
    }

    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            
            return redirect()->intended('mainboard');
        } else {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('mainboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }
}
