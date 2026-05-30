<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ActivityStudent;
use Carbon\Carbon;

class ParentActivityController extends Controller
{
    public function index()
    {
        $student = Student::where('nisn', '3221935788')->first();

        if (!$student) {
            return response()->json([
                'data' => []
            ]);
        }

        $activities = ActivityStudent::with('activity')
            ->where('student_id', $student->id)
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

                    'image' => 'http://10.0.2.2:8000/parent/activity/photo/' . $item->id,
                    
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
}