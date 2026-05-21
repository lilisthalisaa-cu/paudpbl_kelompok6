<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $programs = Program::when($type, function ($query) use ($type) {

            $query->where('type', $type);

        })->latest()->get();

        return view('admin.program.index', compact(
            'programs',
            'type'
        ));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title'       => 'required',
            'description' => 'required',
            'type'        => 'required',
            'image'       => 'required|image'

        ]);

        $image = $request
            ->file('image')
            ->store('programs', 'public');

        Program::create([

            'title'       => $request->title,
            'description' => $request->description,
            'type'        => $request->type,
            'image'       => $image,

        ]);

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program berhasil ditambahkan');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);

        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $data = $request->validate([

            'title'       => 'required',
            'description' => 'required',
            'type'        => 'required',
            'image'       => 'nullable|image'

        ]);

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('programs', 'public');
        }

        $program->update($data);

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program berhasil diupdate');
    }

    public function destroy($id)
    {
        Program::findOrFail($id)->delete();

        return back()
            ->with('success', 'Program berhasil dihapus');
    }
}