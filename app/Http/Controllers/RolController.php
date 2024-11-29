<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.edit')->only('edit', 'update');
        $this->middleware('can:roles.destroy')->only('destroy');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    
    public function create()
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());
       
        $personales = Permission::where('name', 'LIKE', 'personales.%')->orderBy('id', 'asc')->get();
        $proveedores = Permission::where('name', 'LIKE', 'proveedores.%')->orderBy('id', 'asc')->get();
        $clientes = Permission::where('name', 'LIKE', 'clientes.%')->orderBy('id', 'asc')->get();

        $generos =  Permission::where('name', 'LIKE', 'generos.%')->orderBy('id', 'asc')->get();
        $promociones =  Permission::where('name', 'LIKE', 'promociones.%')->orderBy('id', 'asc')->get();
        $productos =  Permission::where('name', 'LIKE', 'productos.%')->orderBy('id', 'asc')->get();

        $inventarios =  Permission::where('name', 'LIKE', 'inventarios.%')->orderBy('id', 'asc')->get();
        $notas =  Permission::where('name', 'LIKE', 'nota-de-ingresos.%')->orderBy('id', 'asc')->get();

        $servicios = Permission::where('name', 'LIKE', 'servicios.%')->orderBy('id', 'asc')->get();

        $roles = Permission::where('name', 'LIKE', 'roles.%')->orderBy('id', 'asc')->get();

        $datos = [ 
            'clientes'=> $clientes,
            'personales' => $personales,
            'proveedores' => $proveedores
        ];

        $productosModule = [
            'generos' => $generos,
            'promociones' => $promociones,
            'productos' => $productos,
        ];

        $inventariosModule = [
            'inventarios' => $inventarios,
            'notas de ingresos' => $notas,
        ];

        $servicioModule =['servicios' => $servicios];
        $rolesModule = ['roles' => $roles];

        $permissions = [
            'datos' => $datos,
            'productos' => $productosModule,
            'inventarios' => $inventariosModule,
            'servicio' => $servicioModule,
            'roles' => $rolesModule,
        ];
      
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->permissions;
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        
        return  redirect()->route('roles.index')->with('success', 'Rol creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        ConfiguracionController::establecerTema();
        Pagina::contarPagina(\request()->path());

        $personales = Permission::where('name', 'LIKE', 'personales.%')->orderBy('id', 'asc')->get();
        $proveedores = Permission::where('name', 'LIKE', 'proveedores.%')->orderBy('id', 'asc')->get();
        $clientes = Permission::where('name', 'LIKE', 'clientes.%')->orderBy('id', 'asc')->get();

        $generos =  Permission::where('name', 'LIKE', 'generos.%')->orderBy('id', 'asc')->get();
        $promociones =  Permission::where('name', 'LIKE', 'promociones.%')->orderBy('id', 'asc')->get();
        $productos =  Permission::where('name', 'LIKE', 'productos.%')->orderBy('id', 'asc')->get();

        $inventarios =  Permission::where('name', 'LIKE', 'inventarios.%')->orderBy('id', 'asc')->get();
        $notas =  Permission::where('name', 'LIKE', 'nota-de-ingresos.%')->orderBy('id', 'asc')->get();

        $servicios = Permission::where('name', 'LIKE', 'servicios.%')->orderBy('id', 'asc')->get();

        $roles = Permission::where('name', 'LIKE', 'roles.%')->orderBy('id', 'asc')->get();

        $datos = [ 
            'clientes'=> $clientes,
            'personales' => $personales,
            'proveedores' => $proveedores
        ];

        $productosModule = [
            'generos' => $generos,
            'promociones' => $promociones,
            'productos' => $productos,
        ];

        $inventariosModule = [
            'inventarios' => $inventarios,
            'notas de ingresos' => $notas,
        ];

        $servicioModule =['servicios' => $servicios];
        $rolesModule = ['roles' => $roles];

        $permissions = [
            'datos' => $datos,
            'productos' => $productosModule,
            'inventarios' => $inventariosModule,
            'servicio' => $servicioModule,
            'roles' => $rolesModule,
        ];
      
       return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $role = Rol::findOrFail($id);
        $usuarios = Usuario::role($role->name)->get();
        if($usuarios->count() > 0)
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar el rol porque tiene usuarios asignados');
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado con éxito');
    }
}
