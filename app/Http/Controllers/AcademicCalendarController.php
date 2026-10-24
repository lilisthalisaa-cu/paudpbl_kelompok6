<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    /**
     * Menampilkan kalender akademik kepada orang tua.
     */
    public function index(Request $request)
    {
        $query = AcademicCalendar::query()
            ->orderBy('start_date');

        // Filter berdasarkan bulan dan tahun jika dipilih.
        if ($request->filled('month') && $request->filled('year')) {
            $month = (int) $request->month;
            $year = (int) $request->year;

            if ($month >= 1 && $month <= 12 && $year >= 2000 && $year <= 2100) {
                $query->whereDate('start_date', '<=', "$year-$month-31")
                    ->whereDate('end_date', '>=', "$year-$month-01");
            }
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $calendars = $query->get();

        $categories = AcademicCalendar::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('parent.academic-calendars.index', compact(
            'calendars',
            'categories'
        ));
    }

    /**
     * Menampilkan detail agenda kepada orang tua.
     */
    public function show(AcademicCalendar $academicCalendar)
    {
        return view(
            'parent.academic-calendars.show',
            compact('academicCalendar')
        );
    }
}
