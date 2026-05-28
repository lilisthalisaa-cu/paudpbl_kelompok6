<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ParentGrowthController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => []
        ]);
    }
}