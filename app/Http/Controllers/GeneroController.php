<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Pagina;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $generos = Genero::all();

        return view('generos.index', compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|unique:generos,nombre',
        ]);

        Genero::create(['nombre' => $request->nombre]);

        return redirect()->route('generos.index')->with('success', 'Género creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genero $genero)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        return view('generos.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genero $genero)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|unique:generos,nombre,' . $genero->id,
        ]);

        $genero->nombre = $request->nombre;
        $genero->save();

        return redirect()->route('generos.index')->with('success', 'Género creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genero $genero)
    {
        $genero->delete();
        return redirect()->route('generos.index')->with('success', 'Género eliminado correctamente');
    }
}
