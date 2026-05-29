<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentNote;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevelopmentNoteController extends Controller
{
    private function teacherClassId()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->value('school_class_id');
    }

    public function index(Request $request)
    {
        $classId = $this->teacherClassId();

        $student_id = $request->student_id;

        $year = $request->year ?? date('Y');

        $data = DevelopmentNote::with('student')

            ->whereHas('student', function ($q) use ($classId) {

                $q->where(
                    'school_class_id',
                    $classId
                );

            })

            ->when($student_id, function ($q) use ($student_id) {

                $q->where('student_id', $student_id);

            })

            ->where('year', $year)

            ->orderByRaw('CAST(month as UNSIGNED) ASC')

            ->get();

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        return view(
            'teacher.development.index',
            compact(
                'data',
                'students',
                'year'
            )
        );
    }

    public function create(Request $request)
    {
        $classId = $this->teacherClassId();

        $month = $request->month ?? date('n');

        $year = $request->year ?? date('Y');

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        $existing = DevelopmentNote::where('month', $month)

            ->where('year', $year)

            ->whereHas('student', function ($q) use ($classId) {

                $q->where(
                    'school_class_id',
                    $classId
                );

            })

            ->get()

            ->keyBy('student_id');

        return view(
            'teacher.development.create',
            compact(
                'students',
                'month',
                'year',
                'existing'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'month' => ['required'],

            'year' => ['required'],

            'developments' => ['required', 'array'],

        ]);

        $classId = $this->teacherClassId();

        $teacher = Teacher::where(
            'user_id',
            Auth::id()
        )->first();

        foreach ($request->developments as $studentId => $item) {

            $student = Student::where(
                    'school_class_id',
                    $classId
                )
                ->find($studentId);

            if (!$student) {
                continue;
            }

            DevelopmentNote::updateOrCreate(

                [
                    'student_id' => $studentId,
                    'month' => $request->month,
                    'year' => $request->year,
                ],

                [
                    'teacher_id' => optional($teacher)->id,
                    'tb' => $item['tb'] ?? null,
                    'bb' => $item['bb'] ?? null,
                    'description' => $item['description'] ?? '-',
                ]
            );
        }

        return back()->with(
            'success',
            'Perkembangan anak berhasil disimpan.'
        );
    }

    public function edit(DevelopmentNote $development)
    {
        $classId = $this->teacherClassId();

        abort_if(
            $development->student->school_class_id != $classId,
            403
        );

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        return view(
            'teacher.development.edit',
            [
                'data' => $development,
                'students' => $students
            ]
        );
    }

    public function update(Request $request, DevelopmentNote $development)
    {
        $classId = $this->teacherClassId();

        abort_if(
            $development->student->school_class_id != $classId,
            403
        );

        $request->validate([

            'student_id' => ['required', 'exists:students,id'],

            'month' => ['required'],

            'year' => ['required'],

            'description' => ['required'],

            'tb' => ['nullable', 'numeric'],

            'bb' => ['nullable', 'numeric'],

        ]);

        $development->update([

            'student_id' => $request->student_id,

            'month' => $request->month,

            'year' => $request->year,

            'tb' => $request->tb,

            'bb' => $request->bb,

            'description' => $request->description,

        ]);

        return redirect()

            ->route('teacher.development.index')

            ->with(
                'success',
                'Data perkembangan berhasil diperbarui.'
            );
    }

    public function destroy(DevelopmentNote $development)
    {
        $classId = $this->teacherClassId();

        abort_if(
            $development->student->school_class_id != $classId,
            403
        );

        $development->delete();

        return back()->with(
            'success',
            'Data perkembangan berhasil dihapus.'
        );
    }
}