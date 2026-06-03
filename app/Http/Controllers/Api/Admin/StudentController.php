<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentAccount;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['schoolClass', 'parent'])->get();

        return response()->json([
            'success' => true,
            'data' => $students->map(function ($s) {
                return [
                    'id' => $s->id,
                    'parent_id' => $s->parent_id,
                    'name' => $s->name,
                    'nisn' => $s->nisn,
                    'gender' => $s->gender,
                    'class_id' => $s->school_class_id,
                    'class_name' => $s->schoolClass?->name,
                    'parent_name' => $s->parent_name,
                    'parent_phone' => $s->parent_phone,
                    'parent_username' => $s->parent?->username,
                    'parent_email' => $s->parent?->email,
                    'address' => $s->address,
                    'is_active' => (bool) $s->is_active,
                ];
            })
        ]);
    }

    public function update(Request $request, $id)
    {
        try {

            $student = Student::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'nisn' => 'nullable',
                'gender' => 'nullable',
                'school_class_id' => 'required',
                'parent_name' => 'nullable',
                'parent_phone' => 'nullable',
                'address' => 'nullable',
                'is_active' => 'nullable',
            ]);

            $student->update([
                'name' => $request->name,
                'nisn' => $request->nisn,
                'gender' => $request->gender,
                'school_class_id' => $request->school_class_id,
                'parent_name' => $request->parent_name,
                'parent_phone' => $request->parent_phone,
                'address' => $request->address,
                'is_active' => $request->is_active ? 1 : 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student berhasil diupdate',
                'data' => $student
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'nisn' => 'required|unique:students,nisn',
                'gender' => 'required',
                'school_class_id' => 'required',
                'parent_name' => 'required',
                'password' => 'required',
            ]);

            $parent = ParentAccount::create([
                'name' => $request->parent_name,
                'nisn' => $request->nisn,
                'password' => Hash::make($request->password),
            ]);

            $user = User::create([
                'name' => $request->parent_name,
                'username' => $request->nisn,
                'password' => $request->password,
                'role' => 'parent',
            ]);

            $student = Student::create([
                'parent_id' => $parent->id,
                'name' => $request->name,
                'nisn' => $request->nisn,
                'gender' => $request->gender,
                'school_class_id' => $request->school_class_id,
                'parent_name' => $request->parent_name,
                'parent_phone' => $request->parent_phone,
                'address' => $request->address,
                'is_active' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student berhasil ditambahkan',
                'data' => $student,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
{
    try {

        $student = Student::findOrFail($id);

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student berhasil dihapus'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}
