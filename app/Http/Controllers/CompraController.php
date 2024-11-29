<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Venta;
use App\Models\Pagina;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
 
    public function index()
    {   
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());

        $ventas = Venta::where('id_cliente', '=', Auth::user()->id)->get();

        return view('compras.index', compact('ventas'));
    }

    
    public function show(string $id)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());

        // el id que me llega es el id de la venta
        $pago = Pago::where('id_venta', '=', $id)->first();

        $detalles = DetalleVenta::where('id_venta', '=', $id)->get();
        $detalles->load('producto');

        return view('compras.show', compact('pago', 'detalles'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
