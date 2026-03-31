<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass; 
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $teachers = Teacher::with('user', 'class')
            ->when($q, function ($query) use ($q) {
                return $query->whereHas('user', function ($subQuery) use ($q) {
                    $subQuery->where('name', 'like', "%{$q}%")
                             ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.teacher.index', compact('teachers', 'q'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('admin.teachers.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required','string','max:255'],
            'email' => ['required','email','unique:user,email'],
            'password' => ['required','string','min:6'],
            'class_id' => ['required']
        ]);

        // simpan ke user
        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'guru'
        ]);

        // simpan ke teacher
        Teacher::create([
            'user_id' => $user->id,
            'class_id' => $data['class_id']
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        $classes = SchoolClass::all();
        return view('admin.teachers.edit', compact('teacher', 'classes'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'nama' => ['required','string','max:255'],
            'email' => ['required','email','unique:user,email,' . $teacher->user->id],
            'class_id' => ['required']
        ]);

        // update user
        $teacher->user->update([
            'name' => $data['nama'],
            'email' => $data['email'],
        ]);

        // update teacher
        $teacher->update([
            'class_id' => $data['class_id']
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil diperbarui');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();

      return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil dihapus');
    }
}