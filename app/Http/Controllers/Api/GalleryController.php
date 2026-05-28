<?php

namespace App\Http\Controllers\Api;

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
                asset(
                    'storage/' .
                    $gallery->image
                );

            return $gallery;
        });

        return response()->json(
            $galleries
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' =>
                'required',

            'category' =>
                'required',

            'image' =>
                'required|image',
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
            asset(
                'storage/' .
                $gallery->image
            );

        return response()->json([
            'message' =>
                'Galeri berhasil ditambahkan',

            'data' =>
                $gallery,
        ]);
    }

    public function update(
        Request $request,
        $id
    ) {

        $gallery =
            Gallery::findOrFail($id);

        $request->validate([

            'title' =>
                'required',

            'category' =>
                'required',
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
            asset(
                'storage/' .
                $gallery->image
            );

        return response()->json([
            'message' =>
                'Galeri berhasil diupdate',

            'data' =>
                $gallery,
        ]);
    }

    public function destroy($id)
    {
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
            'message' =>
                'Galeri berhasil dihapus',
        ]);
    }
}