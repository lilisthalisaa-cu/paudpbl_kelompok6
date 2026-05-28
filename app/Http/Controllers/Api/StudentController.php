<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Student;

class StudentController
    extends Controller
{
    public function index()
    {
        $students = Student::with(
            'schoolClass'
        )->get();

        return response()->json(

            $students->map(function ($s) {

                return [

                    'id' => $s->id,

                    'name' => $s->name,

                    'nisn' => $s->nisn,

                    'gender' => $s->gender,

                    'class' =>
                        $s->schoolClass->name
                        ?? '-',

                    'parent_name' =>
                        $s->parent_name,

                    'parent_phone' =>
                        $s->parent_phone,

                    'address' =>
                        $s->address,

                    'is_active' =>
                        (bool) $s->is_active,
                ];
            })
        );
    }
}