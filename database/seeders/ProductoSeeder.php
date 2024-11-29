<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Producto::create([
            'nombre' => 'Camisa Formal',
            'descripcion' => 'Hermosa camisa formal de la marca Polo',
            'imagen' => 'https://www.opalona.com/images/produits/550x270/550x270_4946-1.jpg',
            'precio' => 80,
            'stock' => 10,
            'id_categoria' => 1,
            'id_promocion' => 1
        ]);
        Producto::create([
            'nombre' => 'Camisa Blanca',
            'descripcion' => 'Hermosa camisa blanca de la marca Polo',
            'imagen' => 'https://www.opalona.com/images/produits/550x270/550x270_4706-1.jpg',
            'precio' => 80,
            'stock' => 10,
            'id_categoria' => 1,
            'id_promocion' => 1
        ]);
        Producto::create([
            'nombre' => 'Camisa Casual',
            'descripcion' => 'Hermosa camisa casual de la marca Polo',
            'imagen' => 'https://www.opalona.com/images/produits/550x270/550x270_4469-1.jpg',
            'precio' => 90,
            'stock' => 10,
            'id_categoria' => 1,
            'id_promocion' => 1
        ]);
        Producto::create([
            'nombre' => 'Zapatos de Vestir',
            'descripcion' => 'Hermosos zapatos de vestir de la marca Zapatoterapia',
            'imagen' => 'https://http2.mlstatic.com/D_NQ_NP_2X_793316-MLA46592572671_072021-T.webp',
            'precio' => 40,
            'stock' => 10,
            'id_categoria' => 4,
            'id_promocion' => 1
        ]);
        Producto::create([
            'nombre' => 'Pantalon Jean',
            'descripcion' => 'Hermosa pantalon jean de la marca Levis',
            'imagen' => 'https://www.shutterstock.com/image-photo/blue-jeans-pant-leather-blank-260nw-1722223636.jpg',
            'precio' => 60,
            'stock' => 10,
            'id_categoria' => 2,
            'id_promocion' => 1
        ]);
        Producto::create([
            'nombre' => 'Boxer Lupo',
            'descripcion' => 'Boxer varonil de la marca Lupo',
            'imagen' => 'https://www.shopattitudefashion.com/cdn/shop/files/ScreenShot2023-12-14at5.38.58PM.png?v=1702593681&width=1000',
            'precio' => 60,
            'stock' => 10,
            'id_categoria' => 3,
            'id_promocion' => 1
        ]);
    }
}
