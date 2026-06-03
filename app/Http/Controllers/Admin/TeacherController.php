<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $teachers = Teacher::with([
            'user',
            'schoolClass'
        ])
        ->when($q, function ($query) use ($q) {

            $query->whereHas('user', function ($sub) use ($q) {

                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");

            });

        })
        ->paginate(10);

        return view(
            'admin.teacher.index',
            compact(
                'teachers',
                'q'
            )
        );
    }

    public function create()
    {
        $classes = SchoolClass::all();

        return view(
            'admin.teacher.create',
            compact('classes')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'name' =>
                'required|string|max:255',

            'username' =>
                'required|string|max:255|unique:users,username',

            'password' =>
                'required|string|min:6',

            'class_id' =>
                'nullable|exists:school_classes,id',

            'phone' =>
                'nullable|string|max:20',

            'address' =>
                'nullable|string|max:255',

            'nip' =>
                'nullable|string|max:50',
        ]);

        DB::transaction(function () use ($data) {

            $user = User::create([

                'name' =>
                    $data['name'],

                'username' =>
                    $data['username'],

                'email' =>
                    $data['username'],

                'password' =>
                    Hash::make($data['password']),

                'role' =>
                    'teacher',
            ]);

            Teacher::create([

                'user_id' =>
                    $user->id,

                'school_class_id' =>
                    $data['class_id'] ?? null,

                'phone' =>
                    $data['phone'] ?? null,

                'address' =>
                    $data['address'] ?? null,

                'nip' =>
                    $data['nip'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Guru berhasil ditambahkan'
            );
    }

    public function edit(Teacher $teacher)
    {
        $classes = SchoolClass::all();

        return view(
            'admin.teacher.edit',
            compact(
                'teacher',
                'classes'
            )
        );
    }

    public function update(
        Request $request,
        Teacher $teacher
    ) {

        $data = $request->validate([

            'name' =>
                'required|string|max:255',

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')
                    ->ignore($teacher->user_id),
            ],

            'class_id' =>
                'nullable|exists:school_classes,id',

            'phone' =>
                'nullable|string|max:20',

            'address' =>
                'nullable|string|max:255',

            'nip' =>
                'nullable|string|max:50',
        ]);

        DB::transaction(function () use (
            $teacher,
            $data
        ) {

            if ($teacher->user) {

                $teacher->user->update([

                    'name' =>
                        $data['name'],

                    'username' =>
                        $data['username'],

                    'email' =>
                        $data['username'],
                ]);
            }

            $teacher->update([

                'school_class_id' =>
                    $data['class_id'] ?? null,

                'phone' =>
                    $data['phone'] ?? null,

                'address' =>
                    $data['address'] ?? null,

                'nip' =>
                    $data['nip'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Guru berhasil diperbarui'
            );
    }

    public function destroy(Teacher $teacher)
    {
        DB::transaction(function () use ($teacher) {

            if ($teacher->user) {
                $teacher->user->delete();
            }

            $teacher->delete();
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Guru berhasil dihapus'
            );
    }
}