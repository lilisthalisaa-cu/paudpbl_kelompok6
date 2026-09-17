<?php

namespace App\Http\Controllers;

use App\Models\DailyChecklist;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ChecklistPdfController extends Controller
{
    public function export($date)
{
    $teacher = Teacher::where(
        'user_id',
        Auth::id()
    )->firstOrFail();

    $checklists = DailyChecklist::with([
        'student',
        'teacher',
        'schoolClass'
    ])
    ->where(
        'teacher_id',
        $teacher->id
    )
    ->whereDate(
        'date',
        $date
    )
    ->orderBy('student_id')
    ->get();

    if ($checklists->isEmpty()) {
        return back()->with(
            'error',
            'Data checklist pada tanggal tersebut belum tersedia.'
        );
    }

    $pdf = Pdf::loadView(
        'teacher.checklist.pdf',
        compact(
            'teacher',
            'checklists',
            'date'
        )
    );

    return $pdf->download(
        'checklist-harian-' . $date . '.pdf'
    );
}
}
