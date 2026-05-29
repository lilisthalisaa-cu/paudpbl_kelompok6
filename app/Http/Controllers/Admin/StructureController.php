<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function index()
    {
        $structures = Structure::latest()->get();

        return view(
            'admin.structure.index',
            compact('structures')
        );
    }

    public function create()
    {
        return view('admin.structure.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'name' => 'required',
            'position' => 'required',
            'description' => 'nullable',
            'type' => 'required',

            'image' => 'nullable|image'

        ]);

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('structure', 'public');
        }

        Structure::create($data);

        return redirect()
            ->route('admin.structure.index')
            ->with('success', 'Data struktur berhasil ditambahkan');
    }

    public function edit(Structure $structure)
    {
        return view(
            'admin.structure.edit',
            compact('structure')
        );
    }

    public function update(Request $request, Structure $structure)
    {
        $data = $request->validate([

            'name' => 'required',
            'position' => 'required',
            'description' => 'nullable',
            'type' => 'required',

            'image' => 'nullable|image'

        ]);

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('structure', 'public');
        }

        $structure->update($data);

        return redirect()
            ->route('admin.structure.index')
            ->with('success', 'Data struktur berhasil diupdate');
    }

    public function destroy(Structure $structure)
    {
        $structure->delete();

        return redirect()
            ->route('admin.structure.index')
            ->with('success', 'Data struktur berhasil dihapus');
    }
}