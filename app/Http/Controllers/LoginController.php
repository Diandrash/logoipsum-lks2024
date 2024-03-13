<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function register(Request $request)  
    {
        return view('auth.register');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|min:3|max:255',
            'password'=> 'required|min:3'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Success', 'Login Success');
            return redirect()->intended('/myarticles');
        }
        Alert::error('Error','Email or Password Incorrect');
        return back();
    }
    public function store (Request $request)
    {
        $ValidatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'email'=> 'required|min:3|max:100|unique:users',
            'password' => 'required|min:3|max:100',
            'is_admin' => 'required'
        ]);

        User::create($ValidatedData);
        Alert::success('Success','Please Login');
        return redirect()->intended('/login');
    }

    public function logout(Request $request)
    {
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        Alert::success('Success','Logout Success');
        return redirect()->intended('/home');
    }

    
}
