<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // 📌 tampilkan semua data
    public function index()
    {
        $profiles = Profile::latest()->get();
        return view('admin.profile.index', compact('profiles'));
    }

    // 📌 form tambah
    public function create()
    {
        return view('admin.profile.create');
    }

    // 📌 simpan data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['title', 'description']);

        // upload gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profiles', 'public');
        }

        Profile::create($data);

        return redirect()->route('profile.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 📌 form edit
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('admin.profile.edit', compact('profile'));
    }

    // 📌 update data
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['title', 'description']);

        // upload gambar baru
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('profiles', 'public');
        }

        $profile->update($data);

        return redirect()->route('profile.index')->with('success', 'Data berhasil diupdate');
    }

    // 📌 hapus data
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'Data berhasil dihapus');
    }
}