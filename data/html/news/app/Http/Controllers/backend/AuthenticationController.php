<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hash;

class AuthenticationController extends Controller
{
    public function __construct() {
        
    }

    public function login()
    {
        return view('backend.login');
    }
    public function action_login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }

        $errors = ['message' => ['Username and/or password invalid.']];
        return redirect()->back()->withErrors($errors);
        
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
    
    
}