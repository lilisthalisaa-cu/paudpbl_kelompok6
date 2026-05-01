<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentActivity;

class GalleryController extends Controller
{
   public function index()
    {
        $activities = StudentActivity::latest()->get();
        return view('website.gallery', compact('activities'));
    }
}
