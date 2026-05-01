<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 🔹 Menampilkan semua data pembayaran
    public function index()
    {
        $payments = Payment::with('student')->get();
        return view('admin.payments.index', compact('payments'));
    }

    // 🔹 Form tambah pembayaran
    public function create()
    {
        $students = Student::all();
        return view('admin.payments.create', compact('students'));
    }

    // 🔹 Simpan pembayaran (admin input)
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'bulan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        Payment::create([
            'student_id' => $request->student_id,
            'bulan' => $request->bulan,
            'jumlah' => $request->jumlah,
            'status' => 'lunas',
            'tanggal_bayar' => now(),
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    // 🔹 Detail pembayaran
    public function show($id)
    {
        $payment = Payment::with('student')->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    // 🔹 Edit pembayaran
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $students = Student::all();
        return view('admin.payments.edit', compact('payment', 'students'));
    }

    // 🔹 Update pembayaran
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'student_id' => $request->student_id,
            'bulan' => $request->bulan,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('payments.index')->with('success', 'Data berhasil diupdate');
    }

    // 🔹 Hapus pembayaran
    public function destroy($id)
    {
        Payment::destroy($id);
        return redirect()->route('payments.index')->with('success', 'Data berhasil dihapus');
    }

    // 🔥 KHUSUS: untuk dashboard parent
    public function getByStudent($student_id)
    {
        $payments = Payment::where('student_id', $student_id)->get();
        return view('parent.payments', compact('payments'));
    }
}