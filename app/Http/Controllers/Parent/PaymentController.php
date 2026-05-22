<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\ParentAccount;
use App\Models\Student;

class PaymentController extends Controller
{
    public function index()
    {
        // ambil parent login
        $parent = ParentAccount::find(
            session('parent_id')
        );

        // jika parent tidak ada
        if (!$parent) {

            abort(404, 'Data parent tidak ditemukan');
        }

        // ambil siswa berdasarkan parent_id
        $student = Student::with('schoolClass')

            ->where(
                'parent_id',
                $parent->id
            )

            ->first();

        // jika siswa tidak ada
        if (!$student) {

            abort(404, 'Data siswa tidak ditemukan');
        }

        // ambil pembayaran
        $payments = Payment::where(
                'student_id',
                $student->id
            )
            ->latest()
            ->get();

        return view(
            'parent.payment.index',
            compact(
                'student',
                'payments'
            )
        );
    }
}