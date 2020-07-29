<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Cupboard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CellController extends Controller
{
    /**
     * Show the form for creating a new Cell.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cupboards = Cupboard::all();
        return view('cells.create', compact('cupboards'));
    }

    /**
     * Store a newly created Cell in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'cupboard_id' => 'required:integer',
            'title' => [
                'required',
                Rule::unique('cells')->where('cupboard_id', $request->get('cupboard_id'))
            ]
        ]);
        $cell = Cell::create($request->all());
        return redirect()
            ->route('cupboards.show', $cell->cupboard->slug)
            ->with('success', "Ячейка {$cell->title} добавлена в шкаф {$cell->cupboard->title}");
    }

    /**
     * Display the specified Cell.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\View\View
     */
    public function show(Cell $cell)
    {
        return view('cells.show', compact('cell'));
    }

    /**
     * Show the form for editing the specified Cell.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\View\View
     */
    public function edit(Cell $cell)
    {
        $cupboards = Cupboard::all();
        return view('cells.edit', compact('cupboards', 'cell'));
    }

    /**
     * Update the specified Cell in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cell $cell)
    {
        $request->validate([
            'cupboard_id' => 'required:integer',
            'title' => [
                'required',
                Rule::unique('cells')
                    ->where('cupboard_id', $request->get('cupboard_id'))
                    ->ignore($cell->id)
            ]
        ]);
        $cell->update($request->all());

        return redirect()
            ->route('cupboards.show', $cell->cupboard->slug)
            ->with('success', "Ячейка {$cell->title} отредактирована!");
    }

    /**
     * Remove the specified Cell from storage.
     *
     * @param \App\Models\Cell $cell
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Cell $cell)
    {
        $title = $cell->title;
        $cell->delete();

        return redirect()->back()->with('success', "Ячейка $title удалена!");
    }
}
