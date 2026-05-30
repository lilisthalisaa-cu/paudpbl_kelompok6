<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class TeacherActivityController extends Controller
{

    public function index(Request $request)
{
    $teacherId = $request->teacher_id;

    $query = Activity::query(); // ✅ FIX DI SINI

    $query->when($teacherId, function ($q) use ($teacherId) {
        $q->where('teacher_id', $teacherId);
    });

    if ($request->year) {
        $query->whereYear('date', $request->year);
    }

    if ($request->month) {
        $query->whereMonth('date', $request->month);
    }

    $data = $query->orderBy('date', 'desc')->get();

    return response()->json([
        'success' => true,
        'role' => 'teacher',
        'data' => $data
    ]);
}

    public function store(Request $request)
    {
        try {

            $request->validate([
                'teacher_id' => 'required',
                'school_class_id' => 'required',
                'date' => 'required',
                'activity_1' => 'required',
                'activity_2' => 'nullable',
                'activity_3' => 'nullable',
            ]);

            $activity = Activity::create([
                'teacher_id' => $request->teacher_id,
                'school_class_id' => $request->school_class_id,
                'date' => $request->date,
                'theme' => 'Kegiatan Harian',
                'activity_1' => $request->activity_1,
                'activity_2' => $request->activity_2,
                'activity_3' => $request->activity_3,
                'notes' => $request->notes,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Activity berhasil disimpan',
                'data' => $activity
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
