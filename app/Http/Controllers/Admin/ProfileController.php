<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::latest()->first();

        return view('admin.profile.index', compact('profile'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title'       => 'required',
            'description' => 'required',

            'npsn'        => 'nullable',
            'address'     => 'nullable',
            'email'       => 'nullable',
            'phone'       => 'nullable',
            'principal'   => 'nullable',
            'established' => 'nullable',

            'vision'      => 'nullable',
            'mission'     => 'nullable',

            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $data = $request->only([

            'title',
            'description',

            'npsn',
            'address',
            'email',
            'phone',
            'principal',
            'established',

            'vision',
            'mission',

        ]);

        // upload gambar
        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('profiles', 'public');
        }

        Profile::create($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([

            'title'       => 'required',
            'description' => 'required',

            'npsn'        => 'nullable',
            'address'     => 'nullable',
            'email'       => 'nullable',
            'phone'       => 'nullable',
            'principal'   => 'nullable',
            'established' => 'nullable',

            'vision'      => 'nullable',
            'mission'     => 'nullable',

            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $data = $request->only([

            'title',
            'description',

            'npsn',
            'address',
            'email',
            'phone',
            'principal',
            'established',

            'vision',
            'mission',

        ]);

        // upload gambar baru
        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('profiles', 'public');
        }

        $profile->update($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);

        $profile->delete();

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Data berhasil dihapus');
    }
}