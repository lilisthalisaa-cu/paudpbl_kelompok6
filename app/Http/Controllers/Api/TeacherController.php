<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with([
            'user',
            'schoolClass'
        ])->get();

        return response()->json(

            $teachers->map(

                function ($teacher) {

                    return [

                        'id' =>
                            $teacher->id,

                        'name' =>
                            $teacher->user?->name,

                        'username' =>
                            $teacher->user?->username,

                        'class' =>
                            $teacher->schoolClass?->name,

                        'phone' =>
                            $teacher->phone,

                        'address' =>
                            $teacher->address,

                        'nip' =>
                            $teacher->nip,
                    ];
                }
            )
        );
    }
}