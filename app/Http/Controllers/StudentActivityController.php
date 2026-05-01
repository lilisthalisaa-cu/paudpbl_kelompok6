<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class StudentActivityController extends Controller
{
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $today = now()->toDateString();

        return view('teacher.activity.create', compact('students', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'date' => ['required', 'date'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], 
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('activities', 'public');
        }

        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();

        if (!$teacher) {
            return back()->withErrors('Data guru tidak ditemukan.');
        }

        StudentActivity::create([
            'student_id' => $request->student_id,
            'teacher_id' => $teacher->id, 
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath, 
        ]);

        return redirect()->route('teacher.activity.index')
            ->with('success', 'Kegiatan berhasil disimpan.');
    }

    public function index()
    {
        $activities = StudentActivity::with('student')
            ->latest()
            ->get();

        return view('teacher.activity.index', compact('activities'));
    }
}