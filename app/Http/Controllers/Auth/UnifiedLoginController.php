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
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        // Admin Npsn
        $admin = User::where('npsn', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        }
    }
}

