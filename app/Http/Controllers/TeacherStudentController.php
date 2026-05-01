<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Models\Student;

class TeacherStudentController extends Controller
{
    public function index()
    {
    $classId = Auth::user()->teacher->school_class_id;

    $students = Student::with('schoolClass')
        ->where('school_class_id', $classId)
        ->get();

    return view('teacher.students.index', compact('students'));
    }

    public function show($id)
    {
        // 🔥 juga pakai with
        $student = Student::with('schoolClass')->findOrFail($id);

        return view('teacher.students.show', compact('student'));
    }
}