<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Structure;

class StructureController
    extends Controller
{
    public function index(
        Request $request
    ) {

        $type =
            $request->type;

        $structures =
            Structure::when(

                $type,

                function (
                    $query
                ) use (
                    $type
                ) {

                    $query->where(
                        'type',
                        $type
                    );
                }

            )->latest()->get();

        return response()->json([

            'data' =>

                $structures->map(

                    function (
                        $item
                    ) {

                        return [

                            'id' =>
                                $item->id,

                            'name' =>
                                $item->name,

                            'position' =>
                                $item->position,

                            'type' =>
                                $item->type,

                            'description' =>
                                $item->description,

                            'image' =>

                                $item->image

                                ? asset(
                                    'storage/' .
                                    $item->image
                                )

                                : null,
                        ];
                    }
                )
        ]);
    }

    public function store(
        Request $request
    ) {

        $request->validate([

            'name' =>
                'required',

            'position' =>
                'required',

            'type' =>
                'required',

            'image' =>
                'nullable|image',

            'description' =>
                'nullable',
        ]);

        $image = null;

        if (
            $request->hasFile(
                'image'
            )
        ) {

            $image =

                $request
                    ->file('image')

                    ->store(
                        'structures',
                        'public'
                    );
        }

        Structure::create([

            'name' =>
                $request->name,

            'position' =>
                $request->position,

            'type' =>
                $request->type,

            'description' =>
                $request->description,

            'image' =>
                $image,
        ]);

        return response()->json([

            'success' => true
        ]);
    }

    public function update(

        Request $request,

        $id
    ) {

        $structure =
            Structure::findOrFail(
                $id
            );

        $image =
            $structure->image;

        if (
            $request->hasFile(
                'image'
            )
        ) {

            $image =

                $request
                    ->file('image')

                    ->store(
                        'structures',
                        'public'
                    );
        }

        $structure->update([

            'name' =>
                $request->name,

            'position' =>
                $request->position,

            'type' =>
                $request->type,

            'description' =>
                $request->description,

            'image' =>
                $image,
        ]);

        return response()->json([

            'success' => true
        ]);
    }

    public function destroy(
        $id
    ) {

        Structure::destroy($id);

        return response()->json([

            'success' => true
        ]);
    }
}