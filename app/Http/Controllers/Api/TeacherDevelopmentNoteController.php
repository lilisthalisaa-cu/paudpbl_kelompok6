<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DevelopmentNote;
use Illuminate\Http\Request;

class TeacherDevelopmentNoteController extends Controller
{
    public function index(Request $request)
    {
        $query = DevelopmentNote::with([
            'student',
            'teacher'
        ]);

        if ($request->student_id) {
            $query->where(
                'student_id',
                $request->student_id
            );
        }

        if ($request->year) {
            $query->where(
                'year',
                $request->year
            );
        }

        $data = $query
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'teacher_id' => 'required',
            'month'      => 'required',
            'year'       => 'required',
            'tb'         => 'required',
            'bb'         => 'required',
        ]);

        $note = DevelopmentNote::create([
            'student_id'  => $request->student_id,
            'teacher_id'  => $request->teacher_id,
            'month'       => $request->month,
            'year'        => $request->year,
            'description' => $request->description,
            'tb'          => $request->tb,
            'bb'          => $request->bb,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan perkembangan berhasil disimpan',
            'data'    => $note,
        ], 201);
    }
}