<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin() 
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
      
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $loginValue = $request->input('login');
        $fieldType  = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/siswa/dashboard');
        }

        return back()->withErrors([
            'login' => 'Kredensial (NIS/Email atau Password) tidak cocok dengan data kami.',
        ])->withInput($request->only('login'));
    }

    public function showRegister() 
    {
        return view('auth.register');
    }

    public function register(Request $request) 
{
 
    $request->validate([
        'name'     => 'required|string|max:255',
        'nis'      => 'required|string|unique:users,nis',
        'kelas'    => 'required|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'nis'      => $request->nis,
        'kelas'    => $request->kelas,
        'password' => Hash::make($request->password),
        'role'     => 'siswa', // Default role
    ]);

    if ($user) {
        
        auth()->login($user);

        return redirect()->route('siswa.dashboard')->with('success', 'Selamat Datang! Registrasi berhasil dan Anda telah masuk.');
    }

    return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
}

    public function logout(Request $request) 
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}