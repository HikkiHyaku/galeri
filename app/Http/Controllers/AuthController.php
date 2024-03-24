<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);
        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Authentication passed...
            return redirect()->intended('/dashboard'); // Redirect to the intended page after successful login
        }

        // If authentication fails, redirect back to the login form with an error message.
        return redirect('/login')->with('error', 'Invalid credentials');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    function showRegisterForm()
    {
        return view('auth.register');
    }

    function create(Request $request)
    {
        // Validasi data
        Session::flash('username', $request->username);
        Session::flash('email', $request->email);
        $request->validate([
            'username' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
        ],[
            'username.required' => 'Username Wajib Diisi',
            'username.unique' => 'Username Telah Digunakan',
            'nama_lengkap.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'email.email' => 'Masukkan Email Yang Valid',
            'email.unique' => 'Email Telah Digunakan Oleh User Lain',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Minimal Password Adalah 8 Karakter',
        ]);

        // Buat pengguna baru
        $data = [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'alamat'=>$request->alamat,
            'password' => bcrypt($request->password),
            'role'=>'user'
        ];
        User::create($data);


        // Redirect pengguna setelah pendaftaran
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
