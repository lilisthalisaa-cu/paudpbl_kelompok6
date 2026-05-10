<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Teacher;

class TeacherStudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {

            return view(
                'teacher.students.index',
                [
                    'students' => collect()
                ]
            );
        }

        $students = Student::with('schoolClass')

            ->where(
                'school_class_id',
                $teacher->school_class_id
            )

            ->orderBy('name')

            ->get();

        return view(
            'teacher.students.index',
            compact('students')
        );
    }

    public function show($id)
    {
        $user = Auth::user();

        $teacher = Teacher::where(
            'user_id',
            $user->id
        )->first();

        if (!$teacher) {
            abort(403);
        }

        $student = Student::with('schoolClass')

            ->where(
                'school_class_id',
                $teacher->school_class_id
            )

            ->findOrFail($id);

        return view(
            'teacher.students.show',
            compact('student')
        );
    }
}