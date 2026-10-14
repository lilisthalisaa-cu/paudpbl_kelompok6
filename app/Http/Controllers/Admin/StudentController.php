<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

        $parentUsers = User::where('role', 'parent')
            ->whereNotNull('username')
            ->where('username', '!=', '')
            ->orderBy('name')
            ->get(['id', 'name', 'username']);

        return view(
            'admin.students.create',
            compact('classes', 'parentUsers')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:50', 'unique:students,nisn'],
            'gender' => ['nullable', 'in:L,P'],
            'school_class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:30'],
            'account_mode' => ['required', Rule::in(['existing', 'new'])],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        if ($request->account_mode === 'existing') {
            $request->validate([
                'parent_user_id' => [
                    'required',
                    Rule::exists('users', 'id')->where('role', 'parent'),
                ],
            ]);
        } else {
            $request->validate([
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:users,username',
                ],
                'password' => ['required', 'string', 'min:6'],
            ]);
        }

        DB::transaction(function () use ($request) {
            if ($request->account_mode === 'existing') {
                $parent = User::where('role', 'parent')
                    ->findOrFail($request->parent_user_id);
            } else {
                $parent = User::create([
                    'name' => $request->parent_name,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role' => 'parent',
                ]);
            }

            Student::create([
                'name' => $request->name,
                'nisn' => $request->nisn,
                'gender' => $request->gender,
                'school_class_id' => $request->school_class_id,
                'parent_name' => $parent->name,
                'parent_phone' => $request->parent_phone,
                'address' => $request->address,
                'is_active' => $request->has('is_active'),
                'parent_id' => $parent->id,
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan dan akun orang tua terhubung.');
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
            'nisn' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'nisn')->ignore($student->id),
            ],
            'gender' => ['nullable', 'in:L,P'],
            'school_class_id' => ['nullable', 'exists:school_classes,id'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $student->update($data);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        // Hapus data siswa saja. Akun orang tua tidak ikut dihapus.
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }
}