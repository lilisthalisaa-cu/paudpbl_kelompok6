<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ActivityStudent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ParentActivityController extends Controller
{
    public function index(Request $request)
{
    $student = Student::where(
        'nisn',
        $request->nisn
    )->first();

    if (!$student) {

        return response()->json([
            'data' => []
        ]);
    }

    $activities = ActivityStudent::with(
            'activity'
        )
        ->where(
            'student_id',
            $student->id
        );

    if ($request->filled('date')) {

        $date = Carbon::createFromFormat(
            'd/m/Y',
            $request->date
        )->format('Y-m-d');

        $activities->whereHas(
            'activity',
            function ($query) use ($date) {

                $query->whereDate(
                    'date',
                    $date
                );
            }
        );
    }

    $activities = $activities
        ->latest()
        ->get()
        ->map(function ($item) {

            return [

                'date' => Carbon::parse(
                    $item->activity->date
                )->format('d/m/Y'),

                'day' => Carbon::parse(
                    $item->activity->date
                )->translatedFormat('l'),

                'image' =>
                    'http://127.0.0.1:8000/api/parent/activity/photo/'
                    . $item->id,

                'activities' => [

                    $item->desc_1,
                    $item->desc_2,
                    $item->desc_3,
                ],
            ];
        });

    return response()->json([
        'data' => $activities
    ]);
}

    public function photo($id)
{
    $activity = ActivityStudent::findOrFail($id);

    if (!$activity->photo) {
        abort(404);
    }

    $file = Storage::path($activity->photo);

    return response()->file($file);
}
}