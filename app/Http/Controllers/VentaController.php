<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Venta;
use App\Models\Pagina;
use GuzzleHttp\Client;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $ventas = Venta::all();
        $ventas->load('cliente');
        $ventas->load('pago');
        $ventas->load('detalleVenta');
        // $ventas->load('detalleVenta.producto');
        return view('ventas.index', compact('ventas'));
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
        try {
            $cliente = Cliente::find(Auth::user()->id);

            if (!$cliente) {
                return redirect()->back()->with('error', 'Usted debe tener una cuenta de tipo cliente');
            }

            DB::beginTransaction();

            $cartJson = json_decode($request->input('cart'), true);

            if ($request->id_servicio != 0) {
                $servicio = Servicio::find($request->id_servicio);
                $request['total'] = $request->total + $servicio->precio;
            }

            $venta = Venta::create([
                'total' => $request->total,
                'id_cliente' => Auth::user()->id,
            ]);

            $detalle = "Productos comprados: ";

            foreach ($cartJson as $cart) {
                // $cart = json_decode($cart);
                // echo gettype($cart)."\n";
                // return $cart['id'];
                DetalleVenta::create([
                    'id_venta' => $venta->id,
                    'id_producto' => $cart['id'],
                    'cantidad' => $cart['cantidad'],
                    'total' => $cart['cantidad'] * $cart['precio'],
                ]);

                // Esto lo deberia hacer manualmente el personal administrativo
                // dado que el pago se tiene que confirmar primero
                // $producto = Producto::find($cart['id']);
                // $producto->stock = $producto->stock - $cart['cantidad'];
                // $producto->update();

                $detalle .= $cart['nombre'] . ", ";
            }
            $detalle .= " - Total: " . $request->total . " Bs.";

            $laQrImage = $this->realizarPagoFacil($request, $venta->id, $detalle);

            Pago::create([
                'detalle' => $detalle,
                'id_venta' => $venta->id,
                'tipo' => $request->tipo_pago == 1 ? "Servicio QR" : "Servicio Tigo Money",
            ]);

            DB::commit();

            // return view('tienda.carrito', compact('laQrImage'));
            return back()->with('laQrImage', $laQrImage);

        } catch (\Throwable $th) {
            // Exception $e
            DB::rollBack();
            return $th->getMessage() . " - " . $th->getLine();
            // return back();
        }
    }


    private function realizarPagoFacil(Request $request, int $id_venta, string $detalle): string
    {
        $lcComerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
        $lnMoneda = 2;
        $lnTelefono = $request->telefono;
        $lcNombreUsuario = $request->nombre;
        $lnCiNit = '123456789';
        $lcNroPago = "venta-" . $id_venta;
        $lnMontoClienteEmpresa = $request->total;
        $lcCorreo = $request->email;
        $lcUrlCallBack = "http://localhost:8000/";
        // $lcUrlReturn           = "http://localhost:8000/";
        $lcUrlReturn = "";
        $laPedidoDetalle = $detalle;
        $lcUrl = "";

        $loClient = new Client();
        $tnTipoServicio = $request->tipo_pago;

        if ($tnTipoServicio == 1) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
        } elseif ($tnTipoServicio == 2) {
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
        }

        $laHeader = ['Accept' => 'application/json'];

        $laBody = [
            "tcCommerceID" => $lcComerceID,
            "tnMoneda" => $lnMoneda,
            "tnTelefono" => $lnTelefono,
            'tcNombreUsuario' => $lcNombreUsuario,
            'tnCiNit' => $lnCiNit,
            'tcNroPago' => $lcNroPago,
            "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
            "tcCorreo" => $lcCorreo,
            'tcUrlCallBack' => $lcUrlCallBack,
            "tcUrlReturn" => $lcUrlReturn,
            'taPedidoDetalle' => $laPedidoDetalle
        ];

        $loResponse = $loClient->post($lcUrl, [
            'headers' => $laHeader,
            'json' => $laBody
        ]);

        $laResult = json_decode($loResponse->getBody()->getContents());

        if ($tnTipoServicio == 1) {

            $laValues = explode(";", $laResult->values)[1];

            $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
            // echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            return $laQrImage;
        } elseif ($tnTipoServicio == 2) {
            echo $laResult->values;
        }
    }

    public function show(Venta $venta)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $pago = Pago::where('id_venta', '=', $venta->id)->first();
        $pago->estado = 'pagado';
        $pago->save();

        $detalles = DetalleVenta::where('id_venta', '=', $venta->id)->get();

        foreach ($detalles as $detalle) {
            $producto = Producto::find($detalle->id_producto);
            $producto->stock = $producto->stock - $detalle->cantidad;
            $producto->save();
        }

        return redirect()->route('ventas.index')->with('success', 'Estado cambiado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
