<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();

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

    public function store(Request $request)
    {
        try {

            $request->validate([

                'title' =>
                    'required',

                'type' =>
                    'required',

                'description' =>
                    'required',
            ]);

            $program = Program::create([

                'title' =>
                    $request->title,

                'type' =>
                    $request->type,

                'description' =>
                    $request->description,
            ]);

            return response()->json([

                'success' => true,

                'message' =>
                    'Program berhasil ditambahkan',

                'data' =>
                    $program,
            ], 201);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),
            ], 500);
        }
    }

    public function update(
        Request $request,
        $id
    ) {

        try {

            $program =
                Program::findOrFail($id);

            $request->validate([

                'title' =>
                    'required',

                'type' =>
                    'required',

                'description' =>
                    'required',
            ]);

            $program->update([

                'title' =>
                    $request->title,

                'type' =>
                    $request->type,

                'description' =>
                    $request->description,
            ]);

            return response()->json([

                'success' => true,

                'message' =>
                    'Program berhasil diupdate',

                'data' =>
                    $program,
            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $program =
                Program::findOrFail($id);

            $program->delete();

            return response()->json([

                'success' => true,

                'message' =>
                    'Program berhasil dihapus',
            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),
            ], 500);
        }
    }
}