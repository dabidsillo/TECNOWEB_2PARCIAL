<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Usuario;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $proveedores = Proveedor::all();
        $proveedores->load('usuario');

        return view('proveedores.index', compact('proveedores'));
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
            'nit' => ['required'],
            'empresa' => ['required', 'string', 'max:100', 'min:3'],
        ]);

        $user = Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ])->assignRole('proveedor');

        Proveedor::create([
            'id' => $user->id,
            'nit' => $request->nit,
            'empresa' => $request->empresa,
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedore)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $proveedor = $proveedore;

        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedore)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:App\Models\Usuario,email,'.$proveedore->id],
            'nombre' => ['required', 'string', 'max:50', 'min:3'],
            'telefono' => ['required', 'string', 'max:10', 'min:8'],
            'direccion' => ['required', 'string', 'max:100', 'min:10'],
            'nit' => ['required'],
            'empresa' => ['required', 'string', 'max:100', 'min:3'],
        ]);

        $user = Usuario::find($proveedore->id);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->save();

        $proveedor = Proveedor::find($proveedore->id);
        $proveedor->nit = $request->nit;
        $proveedor->empresa = $request->empresa;
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    
    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        $usuario = Usuario::find($proveedore->id);
        $usuario->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }
}
