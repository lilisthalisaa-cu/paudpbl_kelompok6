<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentNote;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DevelopmentNoteController extends Controller
{
    public function index(Request $request)
    {
        $student_id = $request->student_id;
        $month = $request->month;

        $data = DevelopmentNote::with('student')
            ->when($student_id, function ($q) use ($student_id) {
                $q->where('student_id', $student_id);
            })
            ->when($month, function ($q) use ($month) {
                $q->where('month', $month);
            })
            ->latest()
            ->get();

        $students = Student::orderBy('name')->get();

        return view('teacher.development.index', compact('data', 'students'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();

        return view('teacher.development.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'month' => ['required'],
            'year' => ['required'],
            'description' => ['required'],
            'tb' => ['nullable', 'numeric'],
            'bb' => ['nullable', 'numeric'],
        ]);

        $teacher = Teacher::where('user_id', auth()->id())->first();

        if (!$teacher) {
            return back()->withErrors('Data guru tidak ditemukan.');
        }
  
        $exists = DevelopmentNote::where('student_id', $request->student_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors('Laporan bulan ini untuk siswa tersebut sudah ada!')
                ->withInput();
        }

        DevelopmentNote::create([
            'student_id' => $request->student_id,
            'teacher_id' => $teacher->id,
            'month' => $request->month,
            'year' => $request->year,
            'description' => $request->description,
            'tb' => $request->tb,
            'bb' => $request->bb,
        ]);

        return redirect()->route('teacher.development.index')
            ->with('success', 'Catatan perkembangan berhasil disimpan.');
    }

    public function edit(DevelopmentNote $development)
    {
        $data = $development; 

        $students = Student::orderBy('name')->get();

        return view('teacher.development.edit', compact('data', 'students'));
    }

    public function update(Request $request, DevelopmentNote $development)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'month' => ['required'],
            'year' => ['required'],
            'description' => ['required'],
            'tb' => ['nullable', 'numeric'],
            'bb' => ['nullable', 'numeric'],
        ]);
        
        $exists = DevelopmentNote::where('student_id', $request->student_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('id', '!=', $development->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors('Data bulan ini sudah ada!')
                ->withInput();
        }

        $development->update([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'year' => $request->year,
            'description' => $request->description,
            'tb' => $request->tb,
            'bb' => $request->bb,
        ]);

        return redirect()->route('teacher.development.index')
            ->with('success', 'Data berhasil diperbarui');
    }
}