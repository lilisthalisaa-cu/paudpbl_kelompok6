<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.payments.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::with(['schoolClass', 'payments'])->findOrFail($id);

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

        $paymentMap = $student->payments->keyBy('bulan');

        $data = [];

        foreach ($months as $m) {
            if (isset($paymentMap[$m])) {
                $data[] = $paymentMap[$m];
            } else {
                $data[] = (object)[
                    'bulan' => $m,
                    'jumlah' => 30000,
                    'status' => 'belum'
                ];
            }
        }

        return view('admin.payments.show', [
            'student' => $student,
            'payments' => $data
        ]);
    }
   
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'bulan' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal_bayar' => 'nullable|date',
        ]);

        Payment::create([
            'student_id' => $data['student_id'],
            'bulan' => $data['bulan'],
            'jumlah' => $data['jumlah'],
            'status' => 'lunas',
            'tanggal_bayar' => $data['tanggal_bayar'] ?? now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil dicatat');
    }

    public function destroy($id)
    {
        Payment::destroy($id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
