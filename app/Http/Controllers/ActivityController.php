<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    private function teacherData()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->firstOrFail();
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
            'teacher.activity.create',
            compact(
                'teacher',
                'students'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'activity_date' => ['required', 'date'],

            'title_1' => ['required'],
            'title_2' => ['nullable'],
            'title_3' => ['nullable'],

            'activities' => ['required', 'array'],

        ]);

        $teacher = $this->teacherData();

        // simpan kegiatan utama kelas
        $activity = Activity::create([

            'teacher_id' => $teacher->id,

            'school_class_id' => $teacher->school_class_id,

            'date' => $request->activity_date,

            'theme' => 'Kegiatan Harian',

            'activity_1' => $request->title_1,

            'activity_2' => $request->title_2,

            'activity_3' => $request->title_3,

            'notes' => null,

        ]);

        // simpan hasil kegiatan masing-masing siswa
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

            ActivityStudent::create([

                'activity_id' => $activity->id,

                'student_id' => $student->id,

                'desc_1' => $item['desc_1'] ?? null,

                'desc_2' => $item['desc_2'] ?? null,

                'desc_3' => $item['desc_3'] ?? null,

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
        $teacher = $this->teacherData();

        $activities = Activity::with('activityStudents')

            ->where(
                'school_class_id',
                $teacher->school_class_id
            )

            ->latest()

            ->paginate(10);

        return view(
            'teacher.activity.index',
            compact('activities')
        );
    }
}