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
    public function index()
    {
        $calendars = AcademicCalendar::orderBy('start_date')
            ->get();

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
            'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
            'category' => 'sometimes|required|string|max:100',
        ]);

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