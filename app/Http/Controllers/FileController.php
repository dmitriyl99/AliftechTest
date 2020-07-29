<?php

namespace App\Http\Controllers;

use App\Models\Cupboard;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FileController extends Controller
{
    /**
     * Show the form for creating a new File.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cupboards = Cupboard::all();

        return view('files.create', compact('cupboards'));
    }

    /**
     * Store a newly created File in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'cupboard_id' => 'required|integer',
            'cell_id' => 'required|integer',
            'folder_id' => 'required|integer',
            'file' => 'required|file'
        ]);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $mime = $file->getMimeType();
        $size = $file->getSize();
        Storage::disk('public')->put($filename, \Illuminate\Support\Facades\File::get($file));
        $file = File::create([
            'filename' => $filename,
            'mime' => $mime,
            'size' => $size,
            'folder_id' => $request->get('folder_id')
        ]);

        return redirect()->route('folders.show', $file->folder->slug)
            ->with('success', "Файл $filename загружен в папку {$file->folder->title}");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\File $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function show(File $file)
    {
        if (strpos($file->mime, 'image') !== false or strpos($file->mime, 'pdf')) {
            return response()->file(Storage::disk('public')->get($file->filename));
        }
        return response()->download(Storage::disk('public')->get($file->filename));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\View\View
     */
    public function edit(File $file)
    {
        $cupboards = Cupboard::all();
        $currentFolder = $file->folder;
        $currentCell = $currentFolder->cell;
        $currentCupboard = $currentCell->cupboard;
        $cells = $currentCupboard->cells;
        $folders = $currentCell->folders;

        return view('file.edit',
            compact('file', 'currentCupboard', 'currentCell', 'currentFolder', 'cupboards', 'cells', 'folders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'cupboard_id' => 'required|integer',
            'cell_id' => 'required|integer',
            'folder_id' => 'required|integer',
        ]);
        $file->update($request->all());

        return redirect()->route('folders.show', $file->folder->slug)
            ->with('success', "Файл {$file->title} отредактирован");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\File $file
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(File $file)
    {
        Storage::disk('public')->delete($file->filename);
        $filename = $file->filename;
        $file->delete();
        return redirect()->back()->with('success', "Файл $filename удалён");
    }
}
