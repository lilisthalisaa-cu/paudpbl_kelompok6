<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $request->validate(

    [

        'activity_date' => ['required', 'date'],

        'title_1' => ['required'],
        'title_2' => ['nullable'],
        'title_3' => ['nullable'],

        'activities' => ['required', 'array'],

        'activities.*.desc_1' => ['required'],
        'activities.*.desc_2' => ['nullable'],
        'activities.*.desc_3' => ['nullable'],

        'activities.*.photo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048'
        ],

    ],

    [

        'title_1.required' =>
            'Pelajaran 1 wajib diisi.',

        'activities.*.photo.image' =>
            'File yang diupload harus berupa gambar.',

        'activities.*.photo.mimes' =>
            'Format gambar hanya JPG, JPEG, PNG, atau WEBP.',

        'activities.*.photo.max' =>
            'Ukuran gambar maksimal 2 MB.',

        'activities.*.desc_1.required' =>
            'Kegiatan 1 setiap siswa wajib diisi.',

    ]

);

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
                    ->store('activities', 'private');
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

    public function index(Request $request)
{
    $teacher = $this->teacherData();

    $studentId = $request->student_id;
    $month = $request->month;

    $activities = Activity::with([
            'activityStudents.student'
        ])
        ->where(
            'school_class_id',
            $teacher->school_class_id
        )

        ->when($month, function ($query) use ($month) {

            $query->whereMonth(
                'date',
                date('m', strtotime($month))
            );

            $query->whereYear(
                'date',
                date('Y', strtotime($month))
            );
        })

        ->latest()
        ->paginate(10)
        ->withQueryString();

    $activities->getCollection()->transform(function ($activity) use ($studentId) {

        $students = $activity->activityStudents;

        if ($studentId) {

            $students = $students->where(
                'student_id',
                $studentId
            );
        }

        $activity->setRelation(
            'activityStudents',
            $students
                ->sortBy(function ($item) {
                    return $item->student->name ?? '';
                })
                ->values()
        );

        return $activity;
    });

    $students = Student::where(
            'school_class_id',
            $teacher->school_class_id
        )
        ->orderBy('name')
        ->get();

    return view(
        'teacher.activity.index',
        compact(
            'activities',
            'students',
            'studentId',
            'month'
        )
    );
}

    public function viewPhoto($id)
{
  
    $activity = \App\Models\ActivityStudent::find($id);

    if (!$activity) {
        $activity = \App\Models\StudentActivity::findOrFail($id);
    }

    if (!$activity->photo) {
        abort(404);
    }

    if (!Storage::disk('private')->exists($activity->photo)) {
    abort(404);
    }

    $file = Storage::disk('private')->path($activity->photo);
    
    return response()->file($file, [
        'Content-Type' => mime_content_type($file)
    ]);
}
}