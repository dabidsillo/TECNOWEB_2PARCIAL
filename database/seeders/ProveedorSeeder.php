<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Proveedor::create(['id' => 4, 'empresa' => 'Amazon', 'nit' => '001234']);
    }
}
