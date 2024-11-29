<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $promociones = Promocion::all();
        return view('promociones.index', compact('promociones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30|unique:promociones,nombre',
            'descuento' => 'required|numeric'
        ]);
        // www.tecnoweb.org.bo
        // grupo02sc

        Promocion::create(['nombre' => $request->nombre, 'descuento' => $request->descuento]);

        return redirect()->route('promocions.index')->with('success', 'Género creado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocion $promocione)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $promocion = $promocione;
        return view('promociones.edit', compact('promocion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocion $promocione)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:30|unique:promociones,nombre,' . $promocione->id,
            'descuento' => 'required|numeric'
        ]);

        $promocione->update($data);

        return redirect()->route('promociones.index')->with('success', 'Género creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocion $promocione)
    {
        $promocione->delete();
        return redirect()->route('promociones.index')->with('success', 'Género eliminado correctamente');
    }
}
