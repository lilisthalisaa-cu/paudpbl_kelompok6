<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();

        $galleries->transform(function ($gallery) {

            $gallery->image =
                $gallery->image
                    ? asset('storage/' . $gallery->image)
                    : null;

            return $gallery;
        });

        return response()->json([
            'success' => true,
            'data' => $galleries,
        ]);
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->image =
            $gallery->image
                ? asset('storage/' . $gallery->image)
                : null;

        return response()->json([
            'success' => true,
            'data' => $gallery,
        ]);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'title' =>
                    'required|unique:galleries,title',

                'category' =>
                    'required',

                'image' =>
                    'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {

                $imagePath =
                    $request
                        ->file('image')
                        ->store(
                            'galleries',
                            'public'
                        );
            }

            $gallery = Gallery::create([

                'title' =>
                    $request->title,

                'category' =>
                    $request->category,

                'image' =>
                    $imagePath,
            ]);

            $gallery->image =
                $gallery->image
                    ? asset(
                        'storage/' .
                        $gallery->image
                    )
                    : null;

            return response()->json([
                'success' => true,
                'message' =>
                    'Galeri berhasil ditambahkan',
                'data' =>
                    $gallery,
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(
        Request $request,
        $id
    ) {

        try {

            $gallery =
                Gallery::findOrFail($id);

            $request->validate([

                'title' =>
                    'required|unique:galleries,title,' . $gallery->id,

                'category' =>
                    'required',

                'image' =>
                    'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($request->hasFile('image')) {

                if (
                    $gallery->image &&
                    Storage::disk('public')
                        ->exists($gallery->image)
                ) {

                    Storage::disk('public')
                        ->delete($gallery->image);
                }

                $gallery->image =
                    $request
                        ->file('image')
                        ->store(
                            'galleries',
                            'public'
                        );
            }

            $gallery->title =
                $request->title;

            $gallery->category =
                $request->category;

            $gallery->save();

            $gallery->image =
                $gallery->image
                    ? asset(
                        'storage/' .
                        $gallery->image
                    )
                    : null;

            return response()->json([
                'success' => true,
                'message' =>
                    'Galeri berhasil diupdate',
                'data' =>
                    $gallery,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $gallery =
                Gallery::findOrFail($id);

            if (
                $gallery->image &&
                Storage::disk('public')
                    ->exists($gallery->image)
            ) {

                Storage::disk('public')
                    ->delete($gallery->image);
            }

            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' =>
                    'Galeri berhasil dihapus',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}