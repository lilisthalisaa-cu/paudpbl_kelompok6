<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{
    public function showLogin()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah'
            ])->withInput();
        }

        session([
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacher->name,
        ]);

        return redirect()->route('teacher.dashboard');
    }

    public function logout()
    {
        session()->forget(['teacher_id', 'teacher_name']);
        return redirect()->route('teacher.login');
    }
}