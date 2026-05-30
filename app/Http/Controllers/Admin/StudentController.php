<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $students = Student::with('schoolClass')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('nisn', 'like', "%{$q}%")
                        ->orWhere('parent_name', 'like', "%{$q}%");
                });
            })
            ->orderBy('school_class_id')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.students.index', compact('students', 'q'));
    }

    public function create()
    {
        $classes = SchoolClass::orderBy('name')->get();

        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:50', 'unique:students,nisn'],
            'gender' => ['nullable', 'in:L,P'],
            'birth_place' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'school_class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['required', 'string'],
            'parent_phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $student = Student::create($data);

        User::create([
            'name' => $student->parent_name,
            'username' => $student->nisn,
            'password' => Hash::make($student->nisn),
            'role' => 'parent',
        ]);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::orderBy('name')->get();

        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $oldNisn = $student->nisn;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:50', 'unique:students,nisn,' . $student->id],
            'gender' => ['nullable', 'in:L,P'],
            'birth_place' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'school_class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['required', 'string'],
            'parent_phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $student->update($data);

        $parentUser = User::where('username', $oldNisn)
            ->where('role', 'parent')
            ->first();

        if ($parentUser) {

            $parentUser->update([
                'name' => $student->parent_name,
                'username' => $student->nisn,
            ]);
        }

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        User::where('username', $student->nisn)
            ->where('role', 'parent')
            ->delete();

        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}