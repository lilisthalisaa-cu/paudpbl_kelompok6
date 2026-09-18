<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $students = Student::with(
            'schoolClass'
        )->get();

        return response()->json([

            'data' => $students->map(
                function ($s) {

                    return [

                        'id' =>
                            $s->id,

                        'name' =>
                            $s->name,

                        'nisn' =>
                            $s->nisn,

                        'class' =>
                            $s->schoolClass->name ?? '-',
                    ];
                }
            )
        ]);
    }

    public function show($id)
    {
        $student = Student::with(
            ['schoolClass', 'payments']
        )->findOrFail($id);

        $months = [

            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $paymentMap =
            $student->payments
                ->keyBy('bulan');

        $data = [];

        foreach ($months as $m) {

            if (isset(
                $paymentMap[$m]
            )) {

                $data[] =
                    $paymentMap[$m];

            } else {

                $data[] = [

                    'bulan' =>
                        $m,

                    'jumlah' =>
                        30000,

                    'status' =>
                        'belum',
                ];
            }
        }

        return response()->json([

            'student' => [

                'id' =>
                    $student->id,

                'name' =>
                    $student->name,

                'nisn' =>
                    $student->nisn,

                'class' =>
                    $student->schoolClass->name ?? '-',
            ],

            'payments' =>
                $data
        ]);
    }

    public function store(
        Request $request
    ) {

        $data =
            $request->validate([

                'student_id' =>
                    'required|exists:students,id',

                'bulan' =>
                    'required|string',

                'jumlah' =>
                    'required|numeric',
            ]);

        Payment::create([

            'student_id' =>
                $data['student_id'],

            'bulan' =>
                $data['bulan'],

            'jumlah' =>
                $data['jumlah'],

            'status' =>
                'lunas',

            'tanggal_bayar' =>
                now(),
        ]);

        return response()->json([

            'success' => true
        ]);
    }
}