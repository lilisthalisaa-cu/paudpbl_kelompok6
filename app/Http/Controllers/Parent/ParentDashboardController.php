<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = Student::with('schoolClass')
            ->where('parent_user_id', $user->id)
            ->first();

        return view('parent.dashboard.index', compact('student'));
    }
}