<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Structure;

class StructureController extends Controller
{
    public function index()
    {
        $kepala = Structure::where(
            'type',
            'kepala'
        )->first();

        $gurus = Structure::where(
            'type',
            'guru'
        )->get();

        return view(
            'website.structure',
            compact(
                'kepala',
                'gurus'
            )
        );
    }
}