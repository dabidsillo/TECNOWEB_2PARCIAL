<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data  = $request->validate([
            'nombre' => 'required|string|max:30',
            'precio' => 'required|numeric'
        ]);

        Servicio::create($data);

        return redirect()->route('servicios.index')->with('success', 'Género creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:30',
            'precio' => 'required|numeric'
        ]);

        $servicio->update($data);

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente');
    }
}
