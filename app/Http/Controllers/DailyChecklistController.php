<?php

namespace App\Http\Controllers;

use App\Models\DailyChecklist;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyChecklistController extends Controller
{
    private function teacherData()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
    }

    public function index(Request $request)
    {
        $teacher = $this->teacherData();

        $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
        ->orderBy('name')
        ->get();

        $checklists = DailyChecklist::with([
            'student',
            'teacher',
            'schoolClass'
        ])
        ->where(
            'teacher_id',
            $teacher->id
        )
        ->latest('date')
        ->paginate(10)
        ->withQueryString();

        return view(
            'teacher.checklist.index',
            compact(
                'teacher',
                'students',
                'checklists'
            )
        );
    }

    public function create()
    {
        $teacher = $this->teacherData();

        $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
        ->orderBy('name')
        ->get();

        return view(
            'teacher.checklist.create',
            compact(
                'teacher',
                'students'
            )
        );
    }

    public function store(Request $request)
    {
        $teacher = $this->teacherData();

        // Tanggal otomatis sesuai tanggal saat checklist disimpan
        $today = now()->toDateString();

        $request->validate([
            'theme' => [
                'nullable',
                'string',
                'max:255'
            ],

            'checklists' => [
                'required',
                'array'
            ],

            'checklists.*.student_id' => [
                'required',
                'exists:students,id'
            ],

            'checklists.*.context' => [
                'required',
                'string'
            ],

            'checklists.*.observation' => [
                'nullable',
                'string'
            ],

            'checklists.*.status' => [
                'required',
                'in:SM,BM'
            ],

            'checklists.*.notes' => [
                'nullable',
                'string'
            ],
        ]);

        foreach ($request->checklists as $item) {

            $student = Student::where(
                'school_class_id',
                $teacher->school_class_id
            )
            ->find($item['student_id']);

            if (!$student) {
                continue;
            }

            DailyChecklist::create([
                'teacher_id' => $teacher->id,
                'student_id' => $student->id,
                'school_class_id' => $teacher->school_class_id,
                'date' => $today,

                'theme' => $request->theme ?: 'Kegiatan Harian',

                // Kolom wajib pada database
                'learning_objective' => $item['observation'] ?? '',

                'context' => $item['context'],
                'observation' => $item['observation'] ?? null,
                'status' => $item['status'] ?? 'BM',
                'notes' => $item['notes'] ?? null,
            ]);
        }

        return redirect()
            ->route('teacher.checklist.index')
            ->with(
                'success',
                'Checklist harian berhasil disimpan.'
            );
    }

    public function show($id)
    {
        $teacher = $this->teacherData();

        $checklist = DailyChecklist::with([
            'student',
            'teacher',
            'schoolClass'
        ])
        ->where(
            'teacher_id',
            $teacher->id
        )
        ->findOrFail($id);

        return view(
            'teacher.checklist.show',
            compact(
                'checklist'
            )
        );
    }
}