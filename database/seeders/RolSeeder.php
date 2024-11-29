<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'super-admin']);
        $personal = Role::create(['name' => 'personal']);
        $proveedor = Role::create(['name' => 'proveedor']);
        $cliente = Role::create(['name' => 'cliente']);

        Permission::create(['name' => 'clientes.index', 'description' => 'ver listado de clientes']);
        Permission::create(['name' => 'clientes.create', 'description' => 'crear cliente']);
        Permission::create(['name' => 'clientes.edit', 'description' => 'editar cliente']);
        Permission::create(['name' => 'clientes.destroy', 'description' => 'eliminar cliete']);

        Permission::create(['name' => 'personales.index', 'description' => 'ver listado de personales']);
        Permission::create(['name' => 'personales.create', 'description' => 'crear personal']);
        Permission::create(['name' => 'personales.edit', 'description' => 'editar personal']);
        Permission::create(['name' => 'personales.destroy', 'description' => 'eliminar personal']);

        Permission::create(['name' => 'proveedores.index', 'description' => 'ver listado de proveedores'])->syncRoles([ $personal]);
        Permission::create(['name' => 'proveedores.create', 'description' => 'crear proveedor'])->syncRoles([$personal]);
        Permission::create(['name' => 'proveedores.edit', 'description' => 'editar proveedor'])->syncRoles([$personal]);
        Permission::create(['name' => 'proveedores.destroy', 'description' => 'eliminar proveedor'])->syncRoles([$personal]);

        Permission::create(['name' => 'generos.index', 'description' => 'ver listado de categorias'])->syncRoles([ $personal]);
        Permission::create(['name' => 'generos.create', 'description' => 'crear categoria'])->syncRoles([$personal]);
        Permission::create(['name' => 'generos.edit', 'description' => 'editar categoria'])->syncRoles([$personal]);
        Permission::create(['name' => 'generos.destroy', 'description' => 'eliminar categoria'])->syncRoles([$personal]);

        Permission::create(['name' => 'promociones.index', 'description' => 'ver listado de promociones'])->syncRoles([ $personal]);
        Permission::create(['name' => 'promociones.create', 'description' => 'crear promoción'])->syncRoles([$personal]);
        Permission::create(['name' => 'promociones.edit', 'description' => 'editar promoción'])->syncRoles([$personal]);
        Permission::create(['name' => 'promociones.destroy', 'description' => 'eliminar promoción'])->syncRoles([$personal]);

        Permission::create(['name' => 'productos.index', 'description' => 'ver listado de productos'])->syncRoles([ $personal]);
        Permission::create(['name' => 'productos.create', 'description' => 'crear producto'])->syncRoles([$personal]);
        Permission::create(['name' => 'productos.edit', 'description' => 'editar producto'])->syncRoles([$personal]);
        Permission::create(['name' => 'productos.destroy', 'description' => 'eliminar producto'])->syncRoles([$personal]);

        Permission::create(['name' => 'servicios.index', 'description' => 'ver listado de servicios'])->syncRoles([ $personal]);
        Permission::create(['name' => 'servicios.create', 'description' => 'crear servicio'])->syncRoles([$personal]);
        Permission::create(['name' => 'servicios.edit', 'description' => 'editar servicios'])->syncRoles([$personal]);
        Permission::create(['name' => 'servicios.destroy', 'description' => 'eliminar servicios'])->syncRoles([$personal]);

        Permission::create(['name' => 'ventas.index', 'description' => 'ver listado de ventas'])->syncRoles([ $personal]);

        Permission::create(['name' => 'pagos.index', 'description' => 'ver listado de pagos'])->syncRoles([ $personal]);
        Permission::create(['name' => 'pagos.edit', 'description' => 'editar pago'])->syncRoles([$personal]);

        Permission::create(['name' => 'inventarios.index', 'description' => 'ver listado de inventarios'])->syncRoles([ $personal]);
        Permission::create(['name' => 'inventarios.create', 'description' => 'crear inventario'])->syncRoles([$personal]);
        Permission::create(['name' => 'inventarios.edit', 'description' => 'editar inventario'])->syncRoles([$personal]);
        Permission::create(['name' => 'inventarios.destroy', 'description' => 'eliminar inventario'])->syncRoles([$personal]);

        Permission::create(['name' => 'nota-de-ingresos.index', 'description' => 'ver listado de notas de ingreso'])->syncRoles([ $personal]);
        Permission::create(['name' => 'nota-de-ingresos.create', 'description' => 'crear nota de ingreso'])->syncRoles([$personal]);
        Permission::create(['name' => 'nota-de-ingresos.edit', 'description' => 'editar nota de ingreso'])->syncRoles([$personal]);

        Permission::create(['name' => 'compras.index', 'description' => 'ver listado de compras'])->syncRoles([$cliente]);

        Permission::create(['name' => 'roles.index', 'description' => 'ver listado de roles']);
        Permission::create(['name' => 'roles.create', 'description' => 'crear rol']);
        Permission::create(['name' => 'roles.edit', 'description' => 'editar rol']);
        Permission::create(['name' => 'roles.destroy', 'description' => 'eliminar rol']);

    }
}
