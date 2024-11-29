<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaginaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pagina::create(['path' => '', 'visitas' => 0]); //vista de inicio ejemplo: http://localhost:8000/
        Pagina::create(['path' => 'carrito', 'visitas' => 0]);
        Pagina::create(['path' => 'login', 'visitas' => 0]);
        Pagina::create(['path' => 'register', 'visitas' => 0]);

        Pagina::create(['path' => 'dashboard', 'visitas' => 0]);
        Pagina::create(['path' => 'clientes', 'visitas' => 0]);
        Pagina::create(['path' => 'clientes/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'personales', 'visitas' => 0]);
        Pagina::create(['path' => 'personales/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'proveedores', 'visitas' => 0]);
        Pagina::create(['path' => 'proveedores/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'generos', 'visitas' => 0]);
        Pagina::create(['path' => 'generos/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'promociones', 'visitas' => 0]);
        Pagina::create(['path' => 'promociones/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'productos', 'visitas' => 0]);
        Pagina::create(['path' => 'productos/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'servicios', 'visitas' => 0]);
        Pagina::create(['path' => 'servicios/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'inventarios', 'visitas' => 0]);
        Pagina::create(['path' => 'inventarios/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'nota-de-ingresos', 'visitas' => 0]);
        Pagina::create(['path' => 'nota-de-ingresos/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'ventas', 'visitas' => 0]);
        Pagina::create(['path' => 'roles', 'visitas' => 0]);
        Pagina::create(['path' => 'roles/create', 'visitas' => 0]);
        Pagina::create(['path' => 'roles/edit', 'visitas' => 0]);
        Pagina::create(['path' => 'compras', 'visitas' => 0]);
        Pagina::create(['path' => 'compras/show', 'visitas' => 0]);

        Pagina::create(['path' => 'configuraciones', 'visitas' => 0]);

    }
}
