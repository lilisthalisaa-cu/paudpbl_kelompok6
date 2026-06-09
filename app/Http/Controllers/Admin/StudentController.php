<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $students = Student::with([
            'schoolClass',
            'parent'
        ])
            ->when($q, function ($query) use ($q) {

                $query->where(function ($sub) use ($q) {

                    $sub->where(
                        'name',
                        'like',
                        "%{$q}%"
                    )

                        ->orWhere(
                            'nisn',
                            'like',
                            "%{$q}%"
                        )

                        ->orWhere(
                            'parent_name',
                            'like',
                            "%{$q}%"
                        );
                });
            })
            ->orderBy('school_class_id')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.students.index',
            compact(
                'students',
                'q'
            )
        );
    }

    public function create()
    {
        $classes = SchoolClass::orderBy(
            'name'
        )->get();

        return view(
            'admin.students.create',
            compact(
                'classes'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'name' =>
            'required|string|max:255',

            'nisn' =>
            'required|string|max:50|unique:students,nisn',

            'gender' =>
            'nullable|in:L,P',

            'school_class_id' =>
            'nullable|exists:school_classes,id',

            'parent_name' =>
            'required|string',

            'parent_phone' =>
            'nullable|string',

            'username' =>
            'required|string|max:255|unique:users,username',

            'password' =>
            'required|string|min:6',

            'address' =>
            'nullable|string',

            'is_active' =>
            'nullable',
        ]);

        $data['is_active'] =
            $request->has('is_active');

        DB::transaction(function () use ($data) {

            $user = User::create([

                'name' =>
                $data['parent_name'],

                'username' =>
                $data['username'],

                'email' =>
                filter_var(
                    $data['username'],
                    FILTER_VALIDATE_EMAIL
                )
                    ? $data['username']
                    : null,

                'password' =>
                Hash::make(
                    $data['password']
                ),

                'role' =>
                'parent',
            ]);

            Student::create([

                'parent_id' =>
                $user->id,

                'name' =>
                $data['name'],

                'nisn' =>
                $data['nisn'],

                'gender' =>
                $data['gender'] ?? null,

                'school_class_id' =>
                $data['school_class_id'] ?? null,

                'parent_phone' =>
                $data['parent_phone'] ?? null,

                'address' =>
                $data['address'] ?? null,

                'is_active' =>
                $data['is_active'],
            ]);
        });

        return redirect()
            ->route(
                'admin.students.index'
            )
            ->with(
                'success',
                'Siswa berhasil ditambahkan'
            );
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::orderBy(
            'name'
        )->get();

        return view(
            'admin.students.edit',
            compact(
                'student',
                'classes'
            )
        );
    }

    public function update(
        Request $request,
        Student $student
    ) {

        $data = $request->validate([

            'name' =>
            'required|string|max:255',

            'nisn' =>
            'required|string|max:50|unique:students,nisn,' .
                $student->id,

            'gender' =>
            'nullable|in:L,P',

            'school_class_id' =>
            'nullable|exists:school_classes,id',

            'parent_name' =>
            'required|string',

            'parent_phone' =>
            'nullable|string',

            'address' =>
            'nullable|string',

            'is_active' =>
            'nullable',
        ]);

        $data['is_active'] =
            $request->has('is_active');

        DB::transaction(function () use (
            $student,
            $data
        ) {

            $student->update([

                'name' =>
                $data['name'],

                'nisn' =>
                $data['nisn'],

                'gender' =>
                $data['gender'] ?? null,

                'school_class_id' =>
                $data['school_class_id'] ?? null,

                'parent_phone' =>
                $data['parent_phone'] ?? null,

                'address' =>
                $data['address'] ?? null,

                'is_active' =>
                $data['is_active'],
            ]);

            $parentUser =
                User::find(
                    $student->parent_id
                );

            if ($parentUser) {

                $parentUser->update([

                    'name' =>
                    $data['parent_name'],
                ]);
            }
        });

        return redirect()
            ->route(
                'admin.students.index'
            )
            ->with(
                'success',
                'Siswa berhasil diperbarui'
            );
    }

    public function destroy(
        Student $student
    ) {

        DB::transaction(function () use (
            $student
        ) {

            User::where(
                'id',
                $student->parent_id
            )->delete();

            $student->delete();
        });

        return redirect()
            ->route(
                'admin.students.index'
            )
            ->with(
                'success',
                'Siswa berhasil dihapus'
            );
    }
}
