<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentAuthController extends Controller
{
    public function showLogin()
    {
        return view('parent.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Username akun orang tua menggunakan NISN.
        $parent = User::where('username', $request->nisn)
            ->where('role', 'parent')
            ->first();

        if (
            !$parent ||
            !Hash::check($request->password, $parent->password)
        ) {
            return back()
                ->withErrors([
                    'nisn' => 'NISN atau password salah.',
                ])
                ->withInput($request->only('nisn'));
        }

        // Simpan ID akun users, bukan ID parent_accounts.
        session([
            'parent_id' => $parent->id,
            'parent_name' => $parent->name,
            'parent_nisn' => $parent->username,
        ]);

        return redirect()->route('parent.dashboard');
    }

    public function dashboard()
    {
        $parent = User::with('students.schoolClass')
            ->where('id', session('parent_id'))
            ->where('role', 'parent')
            ->first();

        if (!$parent) {
            session()->forget([
                'parent_id',
                'parent_name',
                'parent_nisn',
            ]);

            return redirect()->route('parent.login');
        }

        // Pertahankan variabel $student agar view lama tetap kompatibel.
        $student = $parent->students->first();

        $activities = [];
        $paymentStatus = 'Belum Lunas';
        $paymentAmount = 150000;
        $paymentHistories = [];

        return view(
            'parent.dashboard',
            compact(
                'student',
                'activities',
                'paymentStatus',
                'paymentAmount',
                'paymentHistories'
            )
        );
    }

    public function logout()
    {
        session()->forget([
            'parent_id',
            'parent_name',
            'parent_nisn',
        ]);

        return redirect()->route('parent.login');
    }
}