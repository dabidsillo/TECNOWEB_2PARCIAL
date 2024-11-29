<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Pagina;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    
    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $productos = Producto::all();
        $productos->load('promocion');
        $generos = Genero::all();
        $generos->load('productos');

        $modo = session('modo', 'light');
        $modo = $modo == 'light' ?  '' : 'dark';
        
        return view('tienda.inicio', compact('productos', 'generos', 'modo'));
    }

    public function carrito() 
    {
        Pagina::contarPagina(\request()->path());
        $servicios = Servicio::all();

        $modo = session('modo', 'light');
        $modo = $modo == 'light' ?  '' : 'dark';

        return view('tienda.carrito', compact('servicios', 'modo'));
    }

    public function setTheme(Request $request)
    {
        $modo = session('modo', 'light');

        if ($modo == 'light') {
            session(['modo' => 'dark']);
        } else {
            session(['modo' => 'light']);
        }

        return back();
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
