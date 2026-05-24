<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use App\Models\ParentAccount;
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

        $username = $request->username;
        $password = $request->password;

        $admin = User::where('npsn', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {

            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        }

        $teacher = Teacher::whereHas('user', function ($q) use ($username) {
            $q->where('email', $username);
        })->first();

        if ($teacher && Hash::check($password, $teacher->user->password)) {

            Auth::login($teacher->user);
            return redirect()->route('teacher.dashboard');
        }

        $parent = ParentAccount::where('nisn', $username)->first();

        if ($parent && Hash::check($password, $parent->password)) {

            session([
                'parent_id' => $parent->id,
                'parent_name' => $parent->parent_name
            ]);

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

    $login = $request->login;
    $password = $request->password;

    // ADMIN
    $admin = User::where('npsn', $login)->first();

    if ($admin &&
        Hash::check($password, $admin->password)) {

        return response()->json([

            'status' => true,
            'role' => 'admin',
            'name' => $admin->name,

        ]);
    }

    // TEACHER
    $teacher = Teacher::whereHas(
        'user',
        function ($q) use ($login) {

            $q->where('email', $login);

        }
    )->first();

    if ($teacher &&
        Hash::check(
            $password,
            $teacher->user->password
        )) {

        return response()->json([

            'status' => true,
            'role' => 'teacher',
            'name' => $teacher->user->name,

        ]);
    }

    // PARENT
    $parent = ParentAccount::where(
        'nisn',
        $login
    )->first();

    if ($parent &&
        Hash::check(
            $password,
            $parent->password
        )) {

        return response()->json([

            'status' => true,
            'role' => 'parent',
            'name' => $parent->parent_name,

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

        session()->forget([
            'parent_id',
            'parent_name'
        ]);

        return redirect()->route('login');
    }

    
    public function logout(Request $request)
    {
        return $this->destroy($request);
    }
}