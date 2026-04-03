<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UnifiedLoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npsn' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('npsn', $request->npsn)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->role !== 'admin') {
                return back()->withErrors([
                    'npsn' => 'Akses hanya untuk admin'
                ]);
            }

            Auth::login($user);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'npsn' => 'NPSN atau password salah'
        ])->onlyInput('npsn');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}