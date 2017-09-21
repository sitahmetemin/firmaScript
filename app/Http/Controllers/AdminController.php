<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getLogin', 'postLogin']]);
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ], $request->get('remember', false)))
        {
            return redirect()->intended('/');
        }
        return back()->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
