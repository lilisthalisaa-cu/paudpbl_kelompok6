<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $parent = Auth::user();

        $student = Student::with('schoolClass')
            ->where('nisn', trim($parent->username))
            ->first();

        if (!$student) {

            return view(
                'parent.payment.index',
                [
                    'student' => null,
                    'payments' => collect()
                ]
            );
        }

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