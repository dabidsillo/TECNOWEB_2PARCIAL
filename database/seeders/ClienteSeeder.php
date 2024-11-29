<?php

namespace Database\Seeders;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin
        Cliente::create([
            'id' => 1,
            'ci' => '13005671'
        ]);

        Cliente::create([
            'id' => 2,
            'ci' => '1347812'
        ]);
        
    }
}
