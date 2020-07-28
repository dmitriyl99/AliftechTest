<?php

namespace App\Http\Controllers;

use App\Models\Cupboard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CupboardController extends Controller
{

    /**
     * Show the form for creating a new Cupboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cupboards.create');
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
            'title' => 'required|unique:cupboards'
        ]);
        $cupboard = Cupboard::create($request->all());

        return redirect()->route('index')->with('success', "Шкаф {$cupboard->title} добавлен!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupboard  $cupboard
     * @return \Illuminate\View\View
     */
    public function show(Cupboard $cupboard)
    {
        return view('cupboard.show', compact('cupboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupboard  $cupboard
     * @return \Illuminate\View\View
     */
    public function edit(Cupboard $cupboard)
    {
        return view('cupboard.edit', compact('cupboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupboard  $cupboard
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cupboard $cupboard)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('cupboards')->ignore($cupboard->id)
            ]
        ]);
        $cupboard->update($request->all());

        return redirect()->route('index')->with('success', "Шкаф {$cupboard->title} отредактирован!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cupboard $cupboard
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Cupboard $cupboard)
    {
        $title = $cupboard->title;
        $cupboard->delete();

        return redirect()->route('index')->with('success', "Шкаф $title удалён!");
    }
}
