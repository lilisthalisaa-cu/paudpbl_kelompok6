<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // tampilkan semua data
    public function index(Request $request)
    {
        $query = Gallery::latest();

        // FILTER CATEGORY
        if (
            $request->category &&
            $request->category != 'Semua Kategori'
        ) {

            $query->where('category', $request->category);
        }

        // SEARCH
        if ($request->search) {

            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        $galleries = $query->get();

        return view(
            'admin.gallery.index',
            compact('galleries')
        );
    }

    // form tambah
    public function create()
    {
        return view('admin.gallery.create');
    }

    // simpan data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:galleries,title',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'title',
            'category'
        ]);
        // upload gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Data berhasil ditambahkan');
    }

    // form edit
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    // update data
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:galleries,title,' . $gallery->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'title',
            'category'
        ]);

        // upload gambar baru
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Data berhasil diupdate');
    }

    // hapus data
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Data berhasil dihapus');
    }
}
