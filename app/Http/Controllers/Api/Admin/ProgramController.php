<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Models\Program;

class ProgramController
    extends Controller
{
    public function index()
    {
        $programs = Program::latest()
            ->get();

        return response()->json(

            $programs->map(function ($p) {

                return [

                    'id' => $p->id,

                    'title' => $p->title,

                    'description' =>
                        $p->description,

                    'type' => $p->type,

                    'image' => $p->image
                        ? asset(
                            'storage/' .
                            $p->image
                          )
                        : null,
                ];
            })
        );
    }
}