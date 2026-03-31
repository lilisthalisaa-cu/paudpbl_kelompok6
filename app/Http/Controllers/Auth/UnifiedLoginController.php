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
            'npsn' => 'required',
            'password' => 'required'
        ]);

        $npsn = $request->npsn;
        $password = $request->password;

        // cari admin berdasarkan NPSN
        $admin = User::where('npsn', $npsn)->first();

        if ($admin && Hash::check($password, $admin->password)) {

            // cek role admin
            if ($admin->role !== 'admin') {
                return back()->withErrors([
                    'npsn' => 'Akses hanya untuk admin'
                ]);
            }

            Auth::login($admin);

            return redirect()->route('admin.dashboard');
        }

        // kalau gagal login
        return back()->withErrors([
            'npsn' => 'NPSN atau password salah'
        ])->onlyInput('npsn');
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