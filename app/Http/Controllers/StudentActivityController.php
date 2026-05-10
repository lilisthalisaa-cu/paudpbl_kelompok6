<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentActivity;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentActivityController extends Controller
{
    private function teacherClassId()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->value('school_class_id');
    }

    public function create()
    {
        $classId = $this->teacherClassId();

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        return view(
            'teacher.activity.create',
            compact('students')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'title_1' => ['required'],
            'title_2' => ['required'],
            'title_3' => ['required'],
            'activities' => ['required', 'array'],
        ]);

        $teacher = Teacher::where(
            'user_id',
            Auth::id()
        )->firstOrFail();

        foreach ($request->activities as $studentId => $item) {

            $student = Student::where(
                    'school_class_id',
                    $teacher->school_class_id
                )
                ->find($studentId);

            if (!$student) {
                continue;
            }

            $photoPath = null;

            if (
                isset($item['photo']) &&
                $item['photo']
            ) {

                $photoPath = $item['photo']
                    ->store('activities', 'public');
            }

            $description = 
                ($request->title_1 ?? '-') . ': ' . ($item['desc_1'] ?? '-') . "\n\n" .
                ($request->title_2 ?? '-') . ': ' . ($item['desc_2'] ?? '-') . "\n\n" .
                ($request->title_3 ?? '-') . ': ' . ($item['desc_3'] ?? '-');

            StudentActivity::create([

                'student_id' => $student->id,

                'teacher_id' => $teacher->id,

                'date' => $request->date,

                'title' => 'Kegiatan Harian',

                'description' => $description,

                'photo' => $photoPath,


            ]);
        }

        return redirect()

            ->route('teacher.activity.index')

            ->with(
                'success',
                'Kegiatan harian berhasil disimpan.'
            );
    }

    public function index()
    {
        $classId = $this->teacherClassId();

        $activities = StudentActivity::with('student')

            ->whereHas('student', function ($q) use ($classId) {

                $q->where(
                    'school_class_id',
                    $classId
                );
            })

            ->latest()

            ->get();

        return view(
            'teacher.activity.index',
            compact('activities')
        );
    }
}