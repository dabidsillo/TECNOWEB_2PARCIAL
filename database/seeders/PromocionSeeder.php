<?php

namespace Database\Seeders;

use App\Models\Promocion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Promocion::create(['nombre' => 'Navidad', 'descuento' => 30]);
        Promocion::create(['nombre' => 'Verano', 'descuento' => 20]);
        Promocion::create(['nombre' => 'Rebajas', 'descuento' => 25]);
        Promocion::create(['nombre' => 'Black Friday', 'descuento' => 50]);
        Promocion::create(['nombre' => 'Día de San Valentín', 'descuento' => 15]);
        Promocion::create(['nombre' => 'Aniversario', 'descuento' => 10]);
        Promocion::create(['nombre' => 'Fin de Semana', 'descuento' => 15]);
        Promocion::create(['nombre' => 'Vuelta a Clases', 'descuento' => 20]);
        Promocion::create(['nombre' => 'Halloween', 'descuento' => 35]);
        Promocion::create(['nombre' => 'Oferta Especial', 'descuento' => 25]);
    }
}
