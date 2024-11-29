<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inventario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RolSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(PromocionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(PersonalSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(InventarioSeeder::class);
        $this->call(PaginaSeeder::class);


    }
}
