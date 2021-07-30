<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    // 1 silla
    // 2 mesa
    // 3 rockola
    // 4 carpa
    // 5 inflable
    {
        DB::table('producto')->insert([
            [
                'id' => 1,
                'categoria_id' => 1,
                'nombre' => 'Silla de plastico',
                'existencias' => 90,
                'disponibles' => 90,
                'precioCompra' => 150,
                'precioUnitario' => 10,
                'imgNombreVirtual' => 'silla_plastico.jpg',
                'imgNombreFisico' => '1_silla_plastico.jpg'
            ],
            [
                'id' => 2,
                'categoria_id' => 1,
                'nombre' => 'Silla de metal',
                'existencias' => 90,
                'disponibles' => 90,
                'precioCompra' => 200,
                'precioUnitario' => 15,
                'imgNombreVirtual' => 'silla_metal.jpg',
                'imgNombreFisico' => '2_silla_metal.jpg'
            ],
            [
                'id' => 3,
                'categoria_id' => 1,
                'nombre' => 'Sillas alcolchadas',
                'existencias' => 90,
                'disponibles' => 90,
                'precioCompra' => 250,
                'precioUnitario' => 20,
                'imgNombreVirtual' => 'silla_acolchada.jpg',
                'imgNombreFisico' => '3_silla_acolchada.jpg'
            ],
            [
                'id' => 4,
                'categoria_id' => 2,
                'nombre' => 'Mesa de plastico',
                'existencias' => 60,
                'disponibles' => 60,
                'precioCompra' => 300,
                'precioUnitario' => 20,
                'imgNombreVirtual' => 'mesa_plastico.jpg',
                'imgNombreFisico' => '4_mesa_plastico.jpg'
            ],
            [
                'id' => 5,
                'categoria_id' => 2,
                'nombre' => 'Mesa de plastico larga',
                'existencias' => 30,
                'disponibles' => 30,
                'precioCompra' => 150,
                'precioUnitario' => 15,
                'imgNombreVirtual' => 'mesa_plastico_larga.jpg',
                'imgNombreFisico' => '5_mesa_plastico_larga.jpg'
            ],
            [
                'id' => 6,
                'categoria_id' => 2,
                'nombre' => 'Mesa de madera',
                'existencias' => 20,
                'disponibles' => 20,
                'precioCompra' => 450,
                'precioUnitario' => 35,
                'imgNombreVirtual' => 'mesa_madera.jpg',
                'imgNombreFisico' => '6_mesa_madera.jpg'
            ],
            [
                'id' => 7,
                'categoria_id' => 3,
                'nombre' => 'Rockola iphone',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 3000,
                'precioUnitario' => 200,
                'imgNombreVirtual' => 'rockola_iphone.jpg',
                'imgNombreFisico' => '7_rockola_iphone.jpg'
            ],
            [
                'id' => 8,
                'categoria_id' => 3,
                'nombre' => 'Rockola clasica',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 5000,
                'precioUnitario' => 500,
                'imgNombreVirtual' => 'rockola_clasica.jpg',
                'imgNombreFisico' => '8_rockola_clasica.jpg'
            ],
            [
                'id' => 9,
                'categoria_id' => 3,
                'nombre' => 'Rockola color azul',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 2700,
                'precioUnitario' => 140,
                'imgNombreVirtual' => 'rockola_azul.jpg',
                'imgNombreFisico' => '9_rockola_azul.jpg'
            ],
            [
                'id' => 10,
                'categoria_id' => 4,
                'nombre' => 'Carpa blanca 3x3',
                'existencias' => 15,
                'disponibles' => 15,
                'precioCompra' => 600,
                'precioUnitario' => 60,
                'imgNombreVirtual' => 'carpa_blanca_3x3.jpg',
                'imgNombreFisico' => '10_carpa_blanca_3x3.jpg'
            ],
            [
                'id' => 11,
                'categoria_id' => 4,
                'nombre' => 'Carpa blanca con paredes 3x6',
                'existencias' => 15,
                'disponibles' => 15,
                'precioCompra' => 700,
                'precioUnitario' => 70,
                'imgNombreVirtual' => 'carpa_blanca_paredes.jpg',
                'imgNombreFisico' => '11_carpa_blanca_paredes.jpg'
            ],
            [
                'id' => 12,
                'categoria_id' => 4,
                'nombre' => 'Carpa negra 3x3',
                'existencias' => 15,
                'disponibles' => 15,
                'precioCompra' => 600,
                'precioUnitario' => 60,
                'imgNombreVirtual' => 'carpa_negra_3x3.jpg',
                'imgNombreFisico' => '12_carpa_negra_3x3.jpg'
            ],
            [
                'id' => 13,
                'categoria_id' => 5,
                'nombre' => 'Inflable sirena',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 3000,
                'precioUnitario' => 300,
                'imgNombreVirtual' => 'inflable_sirena.jpg',
                'imgNombreFisico' => '13_inflable_sirena.jpg'
            ],
            [
                'id' => 14,
                'categoria_id' => 5,
                'nombre' => 'Inflable castillo',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 2000,
                'precioUnitario' => 200,
                'imgNombreVirtual' => 'inflable_castillo.jpg',
                'imgNombreFisico' => '14_inflable_castillo.jpg'
            ],
            [
                'id' => 15,
                'categoria_id' => 5,
                'nombre' => 'Inflable escaladora',
                'existencias' => 10,
                'disponibles' => 10,
                'precioCompra' => 2000,
                'precioUnitario' => 200,
                'imgNombreVirtual' => 'inflable_escaladora.jpg',
                'imgNombreFisico' => '15_inflable_escaladora.jpg'
            ]
        ]);
    }
}
