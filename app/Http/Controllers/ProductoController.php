<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Pagina;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Inventario;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $productos = Producto::all();
        $generos = Genero::all();
        $promociones = Promocion::all();

        return view('productos.index', compact('productos', 'generos', 'promociones'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg',
            'id_genero' => 'required|numeric',
            'id_promocion' => 'nullable|numeric'
        ]);
        $foto_url = cloudinary()->upload($request->file('imagen')->getRealPath())->getSecurePath();

        $data['imagen'] = $foto_url;

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $generos = Genero::all();
        $promociones = Promocion::all();

        return view('productos.edit', compact('producto', 'generos', 'promociones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'id_genero' => 'required|numeric',
            'id_promocion' => 'nullable|numeric'
        ]);

        if ($request->hasFile('imagen')) {
            $foto_url = cloudinary()->upload($request->file('imagen')->getRealPath())->getSecurePath();
            $data['imagen'] = $foto_url;
        }

        $productoActual = Producto::find($producto->id);
        if ($data['stock'] > $productoActual->stock) {
            $cantidadAumentada = abs($data['stock'] - $productoActual->stock);
            try {
                $inventario = Inventario::where('id_producto', $producto->id)->first();
                $inventario->cantidad_disponible = $inventario->cantidad_disponible - $cantidadAumentada;

                if ($inventario->cantidad_disponible < 0) {
                    return redirect()->back()->with('error', 'No hay stock suficiente en el inventario');
                } 

                $inventario->save();
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Ocurrio un error');
            }
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
