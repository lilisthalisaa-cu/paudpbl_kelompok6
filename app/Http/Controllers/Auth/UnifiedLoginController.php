<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// ⬇️ TAMBAHAN SPRINT 2
use App\Models\Teacher;
use App\Models\ParentAccount;

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

        // ======================
        // SPRINT 2 (TAMBAHAN)
        // ======================

        // LOGIN TEACHER
        $teacher = Teacher::where('npsn', $request->npsn)->first();

        if ($teacher && Hash::check($request->password, $teacher->password)) {

            Auth::guard('teacher')->login($teacher);

            return redirect()->route('teacher.dashboard');
        }

        // LOGIN PARENT
        $parent = ParentAccount::where('npsn', $request->npsn)->first();

        if ($parent && Hash::check($request->password, $parent->password)) {

            Auth::guard('parent')->login($parent);

            return redirect()->route('parent.dashboard');
        }

        return back()->withErrors([
            'npsn' => 'NPSN atau password salah'
        ])->onlyInput('npsn');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Auth::guard('teacher')->logout();
        Auth::guard('parent')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}