<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentAccount;
use App\Models\Student;
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

            'nisn' => 'required',

            'password' => 'required'

        ]);

        $parent = ParentAccount::where(
            'nisn',
            $request->nisn
        )->first();

        if (!$parent) {

            return back()->withErrors([
                'nisn' => 'NISN atau password salah'
            ])->withInput();
        }

        if (
            !Hash::check(
                $request->password,
                $parent->password
            )
        ) {

            return back()->withErrors([
                'nisn' => 'NISN atau password salah'
            ])->withInput();
        }

        session([

            'parent_id' => $parent->id,

            'parent_name' => $parent->name,

            'parent_nisn' => $parent->nisn,

        ]);

        return redirect()->route('parent.dashboard');
    }

    public function dashboard()
    {
        $student = Student::with('schoolClass')

            ->where(
                'nisn',
                session('parent_nisn')
            )

            ->first();

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

            'parent_nisn'

        ]);

        return redirect()->route('parent.login');
    }
}