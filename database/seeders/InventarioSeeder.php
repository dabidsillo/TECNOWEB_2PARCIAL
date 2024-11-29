<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Inventario::create([
            'nombre' => 'Drop: Bershka',
            'cantidad_disponible' => 10,
            'id_producto' => 1,
        ]);
    }
}
