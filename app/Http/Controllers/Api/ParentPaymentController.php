<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;

class ParentPaymentController extends Controller
{
    public function index()
    {
        $student = Student::with('payments')
            ->where('nisn', '3221935788')
            ->first();

        return response()->json([
            'data' => $student?->payments ?? []
        ]);
    }
}