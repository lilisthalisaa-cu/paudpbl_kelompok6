<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Teacher;

class TeacherController
    extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(
            [
                'user',
                'schoolClass'
            ]
        )->get();

        return response()->json(

            $teachers->map(function ($t) {

                return [

                    'id' => $t->id,

                    'name' =>
                        $t->user->name ?? '-',

                    'email' =>
                        $t->user->email ?? '-',

                    'role' =>
                        $t->user->role ?? '-',

                    'class' =>
                        $t->schoolClass->name ?? '-',
                ];
            })
        );
    }
}