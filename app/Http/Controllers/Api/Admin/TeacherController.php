<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with([
            'user',
            'schoolClass'
        ])->get();

        return response()->json([

            'success' => true,

            'data' => $teachers->map(function ($t) {

                return [
                    'id'         => $t->id,
                    'user_id'    => $t->user_id,
                    'name'       => $t->user?->name,
                    'username'   => $t->user?->username,
                    'email'      => $t->user?->email,
                    'role'       => $t->user?->role,
                    'phone'      => $t->phone,
                    'address'    => $t->address,
                    'nip'        => $t->nip,
                    'class_id'   => $t->schoolClass?->id,
                    'class_name' => $t->schoolClass?->name,
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'school_class_id' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'teacher',
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'school_class_id' => $request->school_class_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'nip' => $request->nip,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Guru berhasil ditambahkan',
                'data' => $teacher,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $teacher = Teacher::findOrFail($id);

            $user = User::findOrFail(
                $teacher->user_id
            );

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->username,
            ]);

            $teacher->update([
                'school_class_id' => $request->school_class_id,
                'phone' => $request->phone,
                'address' => $request->address,
                'nip' => $request->nip,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Guru berhasil diupdate',
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

            $teacher = Teacher::findOrFail($id);

            User::where(
                'id',
                $teacher->user_id
            )->delete();

            $teacher->delete();

            return response()->json([
                'success' => true,
                'message' => 'Guru berhasil dihapus'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}