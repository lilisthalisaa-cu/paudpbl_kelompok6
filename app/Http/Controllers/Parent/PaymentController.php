<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;

class PaymentController extends Controller
{
    public function index()
    {
        $student = Student::with('schoolClass')
            ->where('parent_id', session('parent_id'))
            ->first();

        // 🔥 kalau tidak ada data siswa
        if (!$student) {
            return back()->with('error', 'Data siswa tidak ditemukan');
        }

        $payments = Payment::where('student_id', $student->id)->get();

        return view('parent.payment.index', [
            'student' => $student,
            'payments' => $payments
        ]);
    }
}