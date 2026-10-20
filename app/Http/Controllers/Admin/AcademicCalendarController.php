<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    /**
     * Menampilkan seluruh agenda kalender akademik.
     */
    
    public function index(Request $request)
    {
        $query = AcademicCalendar::query();

        // Filter berdasarkan bulan dan tahun.
        if ($request->filled('month') && $request->filled('year')) {
            $request->validate([
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|integer|min:2000|max:2100',
            ]);

            $query->whereMonth('start_date', $request->month)
                ->whereYear('start_date', $request->year);
        }

        // Filter berdasarkan kategori.
        if ($request->filled('category')) {
            $request->validate([
                'category' => 'string|max:100',
            ]);

            $query->where('category', $request->category);
        }

        $calendars = $query->orderBy('start_date')->get();

        return response()->json($calendars);
    }


    /**
     * Menampilkan detail satu agenda.
     */
    public function show(AcademicCalendar $academicCalendar)
    {
        return response()->json($academicCalendar);
    }

    /**
     * Menambahkan agenda kalender akademik.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'category' => 'required|string|max:100',
        ]);

        $data['created_by'] = $request->user()->id;

        $calendar = AcademicCalendar::create($data);

        return response()->json([
            'message' => 'Agenda kalender akademik berhasil ditambahkan.',
            'data' => $calendar,
        ], 201);
    }

    /**
     * Memperbarui agenda kalender akademik.
     */
    
    public function update(
        Request $request,
        AcademicCalendar $academicCalendar
    ) {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|nullable|date',
            'category' => 'sometimes|required|string|max:100',
        ]);

        // Gunakan tanggal baru jika dikirim, jika tidak gunakan tanggal tersimpan.
        $startDate = $data['start_date']
            ?? $academicCalendar->start_date->toDateString();

        $endDate = array_key_exists('end_date', $data)
            ? $data['end_date']
            : $academicCalendar->end_date?->toDateString();

        // Pastikan tanggal akhir tidak lebih awal dari tanggal mulai.
        if ($endDate !== null && $endDate < $startDate) {
            return response()->json([
                'message' => 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.',
                'errors' => [
                    'end_date' => [
                        'Tanggal akhir harus sama dengan atau setelah tanggal mulai.',
                    ],
                ],
            ], 422);
        }

        $academicCalendar->update($data);

        return response()->json([
            'message' => 'Agenda kalender akademik berhasil diperbarui.',
            'data' => $academicCalendar->fresh(),
        ]);
    }


    /**
     * Menghapus agenda kalender akademik.
     */
    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();

        return response()->json([
            'message' => 'Agenda kalender akademik berhasil dihapus.',
        ]);
    }
}