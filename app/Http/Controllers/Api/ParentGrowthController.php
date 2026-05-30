<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\DevelopmentNote;
use Illuminate\Http\Request;

class ParentGrowthController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where(
            'nisn',
            '3221935788'
        )->first();

        if (!$student) {
            return response()->json([
                'data' => []
            ]);
        }

        $growths = DevelopmentNote::where(
            'student_id',
            $student->id
        );

        if ($request->month) {
            $growths->where(
                'month',
                $request->month
            );
        }

        if ($request->year) {
            $growths->where(
                'year',
                $request->year
            );
        }

        $growths = $growths
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {

                return [

                    'date' => $item->month . '/' . $item->year,

                    'month' => (string) $item->month,

                    'year' => (string) $item->year,

                    'description' => (string) $item->description,

                    'tb' => (string) $item->tb,

                    'bb' => (string) $item->bb,

                ];
            });

        return response()->json([
            'data' => $growths
        ]);
    }
}