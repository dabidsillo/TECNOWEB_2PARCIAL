<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Formula;
use Illuminate\Http\Request;

class FormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $formulas = Formula::all();
        return view('formulas.index', compact('formulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        Formula::create($data);

        return redirect()->route('formulas.index')->with('success', 'Fórmula creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formula $formula)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        return view('formulas.edit', compact('formula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formula $formula)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        $formula->update($data);

        return redirect()->route('formulas.index')->with('success', 'Fórmula actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formula $formula)
    {
        $formula->delete();

        return redirect()->route('formulas.index')->with('success', 'Fórmula eliminada correctamente');
    }
}