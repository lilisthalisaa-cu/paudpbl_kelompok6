<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        return view('admin.program.index');
    }
}