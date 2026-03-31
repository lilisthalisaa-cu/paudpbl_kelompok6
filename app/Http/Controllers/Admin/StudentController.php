<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

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
            ->latest()
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
            'nisn' => ['nullable', 'string', 'max:50', 'unique:students,nisn'],
            'gender' => ['nullable','in:L,P'],
            'birth_place' => ['nullable','string'],
            'birth_date' => ['nullable','date'],
            'class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['nullable', 'string'],
            'parent_phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        Student::create($data);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::orderBy('name')->get();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['nullable', 'string', 'max:50', 'unique:students,nisn,' . $student->id],
            'gender' => ['nullable','in:L,P'],
            'birth_place' => ['nullable','string'],
            'birth_date' => ['nullable','date'],
            'class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['nullable', 'string'],
            'parent_phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $student->update($data);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}