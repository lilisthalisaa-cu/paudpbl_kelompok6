<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ParentPaymentController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => []
        ]);
    }
}