<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;

class AcademicCalendarController extends Controller
{
    /**
     * Menampilkan kalender akademik kepada orang tua.
     */
    public function index()
    {
        $calendars = AcademicCalendar::orderBy('start_date')
            ->get();

        return response()->json($calendars);
    }

    /**
     * Menampilkan detail agenda kepada orang tua.
     */
    public function show(AcademicCalendar $academicCalendar)
    {
        return response()->json($academicCalendar);
    }
}
