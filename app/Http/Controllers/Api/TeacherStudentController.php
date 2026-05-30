<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class TeacherStudentController extends Controller
{
    public function index()
    {
        $students = Student::with('schoolClass')->get();

        return response()->json([
            'success' => true,
            'role' => 'teacher',
            'data' => $students,
        ]);
    }
}
