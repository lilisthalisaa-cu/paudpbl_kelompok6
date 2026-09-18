<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Models\SchoolClass;

class SchoolClassController
    extends Controller
{
    public function index()
    {
        return response()->json(

            SchoolClass::select(
                'id',
                'name'
            )->get()
        );
    }
}