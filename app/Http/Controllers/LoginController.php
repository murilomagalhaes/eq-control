<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'senha' => 'required'
        ]);

        $login = $request->login;

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            Auth::attempt(['email' => $login, 'password' => $request->senha], true);
        } else {
            //they sent their username instead 
            Auth::attempt(['login' => $login, 'password' => $request->senha], true);
        }

        if (Auth::check()) {
            //send them where they are going 
            return redirect()->intended('dashboard')->with([
                'success' => 'Bem vindo, ' . Auth::user()->nome . '!'
            ]);
        }

        return back()->withErrors([
            'credenciais' => 'Verifique seu login/senha.'
        ])->withInput();
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('login');
    }
}
