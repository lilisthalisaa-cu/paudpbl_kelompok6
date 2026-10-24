<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    /**
     * Menampilkan daftar agenda kalender akademik.
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

        // Filter berdasarkan nama kegiatan.
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $calendars = $query->orderBy('start_date')->get();

        return view('admin.academic-calendars.index', compact('calendars'));
    }

    /**
     * Menampilkan form tambah kegiatan.
     */
    public function create()
    {
        return view('admin.academic-calendars.create');
    }

    /**
     * Menampilkan detail agenda.
     */
    public function show(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic-calendars.show', compact('academicCalendar'));
    }

    /**
     * Menyimpan agenda kalender akademik.
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

        AcademicCalendar::create($data);

        return redirect()
            ->route('admin.academic-calendars.index')
            ->with('success', 'Kegiatan kalender akademik berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kegiatan.
     */
    public function edit(AcademicCalendar $academicCalendar)
    {
        return view('admin.academic-calendars.edit', compact('academicCalendar'));
    }

    /**
     * Memperbarui agenda kalender akademik.
     */
    public function update(
        Request $request,
        AcademicCalendar $academicCalendar
    ) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'category' => 'required|string|max:100',
        ]);

        $academicCalendar->update($data);

        return redirect()
            ->route('admin.academic-calendars.index')
            ->with('success', 'Kegiatan kalender akademik berhasil diperbarui.');
    }

    /**
     * Menghapus agenda kalender akademik.
     */
    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();

        return redirect()
            ->route('admin.academic-calendars.index')
            ->with('success', 'Kegiatan kalender akademik berhasil dihapus.');
    }
}
