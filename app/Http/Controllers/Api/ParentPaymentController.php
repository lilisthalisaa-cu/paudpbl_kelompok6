<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class ParentPaymentController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::with('payments')
            ->where(
                'nisn',
                $request->nisn
            )
            ->first();

        return response()->json([
            'data' => $student?->payments ?? []
        ]);
    }
}