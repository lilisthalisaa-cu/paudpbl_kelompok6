<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UnifiedLoginController extends Controller
{
    // tampilkan login
    public function create()
    {
        return view('auth.login');
    }

    // proses login
    public function store(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required'
    ]);

    $login = $request->login;
    $password = $request->password;

    $admin = User::where('npsn', $login)->first();

    if ($admin && Hash::check($password, $admin->password)) {

        if ($admin->role !== 'admin') {
            return back()->withErrors([
                'login' => 'Akses hanya untuk admin'
            ]);
        }

        Auth::login($admin);

        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'login' => 'NPSN atau password salah'
    ])->onlyInput('login');
}

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}