<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function profile()
    {
        $profile = Profile::latest()->first();

        return view(
            'website.profile',
            compact('profile')
        );
    }

    public function visimisi()
    {
        $profile = Profile::latest()->first();

        return view(
            'website.visimisi',
            compact('profile')
        );
    }

    public function contact()
    {
        $profile = Profile::latest()->first();

        return view(
            'website.contact',
            compact('profile')
        );
    }
}