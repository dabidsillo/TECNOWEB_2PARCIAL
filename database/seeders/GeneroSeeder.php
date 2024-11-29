<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Genero::create(['nombre' => 'Camisas']);
        Genero::create(['nombre' => 'Pantalones']);
        Genero::create(['nombre' => 'Ropa Interior']);
        Genero::create(['nombre' => 'Zapatos']);
        
    }
}
