<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([

            'total_teacher' =>
                Teacher::count(),

            'total_student' =>
                Student::count(),

            'total_payment' =>
                Payment::count(),

            'total_gallery' =>
                Gallery::count(),
        ]);
    }
}