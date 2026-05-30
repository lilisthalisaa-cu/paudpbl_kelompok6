<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $username = trim($request->username);
        $password = $request->password;

        // ADMIN
        $admin = User::where('username', $username)
            ->where('role', 'admin')
            ->first();

        if ($admin && Hash::check($password, $admin->password)) {

            Auth::login($admin);

            return redirect()->route('admin.dashboard');
        }

        // TEACHER
        $teacher = User::where('username', $username)
            ->where('role', 'teacher')
            ->first();

        if ($teacher && Hash::check($password, $teacher->password)) {

            Auth::login($teacher);

            return redirect()->route('teacher.dashboard');
        }

        // PARENT
        $parent = User::where('username', $username)
            ->where('role', 'parent')
            ->first();

        if ($parent && Hash::check($password, $parent->password)) {

            Auth::login($parent);

            return redirect()->route('parent.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah'
        ]);
    }

    public function apiLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $login = trim($request->login);
        $password = $request->password;

        // ADMIN
        $admin = User::where('username', $login)
            ->where('role', 'admin')
            ->first();

        if ($admin && Hash::check($password, $admin->password)) {

            return response()->json([
                'status' => true,
                'role' => 'admin',
                'id' => $admin->id,
                'name' => $admin->name,
            ]);
        }

        // TEACHER
        $teacher = User::where('username', $login)
            ->where('role', 'teacher')
            ->first();

        if ($teacher && Hash::check($password, $teacher->password)) {

            return response()->json([
                'status' => true,
                'role' => 'teacher',
                'id' => $teacher->id,
                'name' => $teacher->name,
            ]);
        }

        // PARENT
$parent = User::where('username', $login)
    ->where('role', 'parent')
    ->first();

if ($parent && Hash::check($password, $parent->password)) {

    return response()->json([
        'status' => true,
        'role' => 'parent',
        'id' => $parent->id,
        'name' => $parent->name,
        'username' => $parent->username,
    ]);
}

        return response()->json([
            'status' => false,
            'message' => 'Login gagal',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        return $this->destroy($request);
    }
}