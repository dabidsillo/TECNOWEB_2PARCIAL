<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Producto;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $productos = Producto::all();
        $inventarios = Inventario::all();
        $inventarios->load('producto');

        return view('inventarios.index', compact('productos', 'inventarios'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad_disponible' => 'required|numeric',
            'id_producto' => 'required',
        ]);

        Inventario::create($data);

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $productos = Producto::all();
        return view('inventarios.edit', compact('inventario', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad_disponible' => 'required|numeric',
            'id_producto' => 'required',
        ]);

        $inventario->update($data);

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado correctamente');
    }
}
