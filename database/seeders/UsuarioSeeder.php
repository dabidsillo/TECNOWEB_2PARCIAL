<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $password = bcrypt('12345678');

        //Admin
        Usuario::create([
            'nombre' => 'David Chalar',
            'email' => 'chalar@gmail.com',
            'password' => $password,
            'telefono' => '76078873',
            'direccion' => 'Av. Siempre Viva 123',
        ])->assignRole('super-admin');

        Usuario::create([
            'nombre' => 'Juan Carlos Alberto Contreras Villegas',
            'email' => 'juancarloscontreras@uagrm.edu.bo',
            'password' => $password,
            'telefono' => '77345279',
            'direccion' => 'Av Bush 236',
        ])->assignRole('cliente');

        //Personal
        Usuario::create([
            'nombre' => 'Elmer Fuentes',
            'email' => 'fuentes@gmail.com',
            'password' => $password,
            'telefono' => '71383655',
            'direccion' => 'Av. Siempre Viva 789',
        ])->assignRole('personal');

        //Proveedor
        Usuario::create([
            'nombre' => 'David Cahuasiri',
            'email' => 'cahuasiri@gmail.com',
            'password' => $password,
            'telefono' => '67750503',
            'direccion' => 'Av. Siempre Viva 005',
        ])->assignRole('proveedor');

    }
}
