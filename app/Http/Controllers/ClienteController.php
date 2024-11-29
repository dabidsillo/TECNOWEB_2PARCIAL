<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();

        Pagina::contarPagina(\request()->path());
        $clientes = Cliente::all();
        $clientes->load('usuario');

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:App\Models\Usuario,email'],
            'password' => ['required', 'string'],
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'telefono' => ['required', 'string', 'max:10', 'min:8'],
            'direccion' => ['required', 'string', 'max:100', 'min:10'],
            'ci' => ['required', 'string', 'max:100', 'min:3'],
        ]);

        $user = Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        Cliente::create([
            'id' => $user->id,
            'ci' => $request->ci,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:App\Models\Usuario,email,'.$cliente->id],
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'telefono' => ['required', 'string', 'max:10', 'min:8'],
            'direccion' => ['required', 'string', 'max:100', 'min:10'],
            'ci' => ['required', 'string', 'max:100', 'min:3'],
        ]);

        $user = Usuario::find($cliente->id);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->save();

        $cliente = Cliente::find($cliente->id);
        $cliente->ci = $request->ci;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        $usuario = Usuario::find($cliente->id);
        $usuario->delete();
        
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
