<?php

namespace App\Http\Controllers;

use App\Models\Cupboard;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FolderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cupboards = Cupboard::all();
        return view('folders.create', compact('cupboards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'cupboard_id' => 'required:integer',
            'cell_id' => 'required:integer',
            'title' => [
                'required',
                Rule::unique('folders')->where('cell_id', $request->get('cell_id'))
            ]
        ]);
        $folder = Folder::create($request->all());

        return redirect()->route('cells.show', $folder->cell->slug)
            ->with('success', "Папка {$folder->title} создана в ячейке {$folder->cell->title}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\View\View
     */
    public function show(Folder $folder)
    {
        return view('folders.show', compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\View\View
     */
    public function edit(Folder $folder)
    {
        $cupboards = Cupboard::all();

        return view('folders.edit', compact('folder', 'cupboards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Folder $folder)
    {
        $request->validate([
            'cupboard_id' => 'required:integer',
            'cell_id' => 'required:integer',
            'title' => [
                'required',
                Rule::unique('folders')->where('cell_id', $request->get('cell_id'))
                    ->ignore($folder->id)
            ]
        ]);

        $folder->update($request->all());

        return redirect()->route('cells.show', $folder->cell->slug)
            ->with('success', "Папка {$folder->title} отредактирована!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Folder $folder
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Folder $folder)
    {
        $title = $folder->title;
        $folder->delete();
        return redirect()->back()->with('success', "Папка $title удалена!");
    }
}
