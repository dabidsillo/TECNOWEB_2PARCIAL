<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Pagina;
use Illuminate\Http\Request;
class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $insumos = Insumo::all();   
        return view('insumos.index', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        Insumo::create($request->all());

        return redirect()->route('insumos.index')->with('success', 'Insumo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        return view('insumos.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $insumo->update($request->all());

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();

        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado correctamente');
    }
}