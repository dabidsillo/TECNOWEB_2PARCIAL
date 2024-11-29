<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pagina;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());

        // $productosConVentas = Producto::join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.id_producto')
        //     ->select('productos.id', 'productos.titulo', DB::raw('COUNT(detalle_ventas.id) as cantidad_ventas'))
        //     ->groupBy('productos.id', 'productos.titulo')
        //     ->get();

        $productosConVentas = Producto::join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('productos.id', 'productos.nombre', DB::raw('SUM(detalle_ventas.cantidad) as cantidad_ventas'))
            ->groupBy('productos.id', 'productos.nombre')
            ->get();

        // $productosConTotalVentas = Producto::join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.id_producto')
        //     ->select('productos.id', 'productos.titulo', DB::raw('SUM(detalle_ventas.total) as total_ventas'))
        //     ->groupBy('productos.id', 'productos.titulo')
        //     ->get();
        
        $cantidadPorTipoPago = Pago::select('tipo', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('tipo')
        ->get();

        $colors = [];
        $data = [];

        foreach ($productosConVentas as $ventas) {
            $data['label'][] = $ventas->nombre;
            $data['data'][] = $ventas->cantidad_ventas;

            $colorAleatorio = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $colors[] = $colorAleatorio;
        }

        $data2 = [];

        foreach($cantidadPorTipoPago as $pago) {
            $data2['label'][] = $pago->tipo;
            $data2['data'][] = $pago->cantidad; 
        }


        $data = json_encode($data);
        $colors = json_encode($colors);
        $data2 = json_encode($data2);


        return view('dashboard', compact('productosConVentas', 'data', 'colors', 'data2'));
    }
}
