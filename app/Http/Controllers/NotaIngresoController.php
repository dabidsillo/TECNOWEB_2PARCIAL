<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\NotaIngreso;
use App\Models\Pagina;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $inventarios = Inventario::all();
        $proveedores = Proveedor::all();
        $notas = NotaIngreso::all();
        $notas->load('inventario');
        $notas->load('proveedor');

        return view('notas.index', compact('notas', 'inventarios','proveedores'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|numeric',
            'costo' => 'required|numeric',
            'id_proveedor' => 'required',
            'id_inventario' => 'required',
        ]);

        NotaIngreso::create([
            'cantidad' => $request->cantidad,
            'costo' => $request->costo,
            'total' => $request->cantidad * $request->costo, 
            'id_proveedor' => $request->id_proveedor,
            'id_inventario' => $request->id_inventario,
            'id_personal' => Auth::user()->id,
        ]);

        $inventario = Inventario::find($request->id_inventario);
        $inventario->cantidad_disponible =  $inventario->cantidad_disponible + $request->cantidad;
        $inventario->save();

        return redirect()->route('nota-de-ingresos.index')->with('success', 'Nota de inreso registrado correctamente');
    }

}
