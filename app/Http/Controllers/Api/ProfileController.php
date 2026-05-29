<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile =
            Profile::latest()->first();

        return response()->json($profile);
    }

    public function update(
        Request $request
    ) {

        $profile =
            Profile::latest()->first();

        $profile->update([

            'title' =>
                $request->title,

            'description' =>
                $request->description,

            'email' =>
                $request->email,

            'phone' =>
                $request->phone,

            'address' =>
                $request->address,

            'vision' =>
                $request->vision,

            'mission' =>
                $request->mission,
        ]);

        return response()->json([

            'success' => true
        ]);
    }
}