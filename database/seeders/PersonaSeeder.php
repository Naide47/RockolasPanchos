<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Personas de usuarios
        DB::table('persona')->insert([
            [
                'id' => 1,
                'nombre' => 'Juan Martinez',
                'colonia' => 'Colonia 1',
                'calle' => 'Calle 1',
                'codigoPostal' => '37500',
                'telefono' => '4771234567',
                'celular' => '4777654321'
            ],
            [
                'id' => 2,
                'nombre' => 'Alejandro Rodriguez',
                'colonia' => 'Colonia 2',
                'calle' => 'Calle 2',
                'codigoPostal' => '38000',
                'telefono' => '4779541357',
                'celular' => '4776549873'
            ],
            [
                'id' => 3,
                'nombre' => 'Marta Salazar',
                'colonia' => 'Colonia 3',
                'calle' => 'Calle 3',
                'codigoPostal' => '38500',
                'telefono' => '4776352146',
                'celular' => '4778546324'
            ],
            [
                'id' => 4,
                'nombre' => 'Cecilia Alcantar',
                'colonia' => 'Colonia 4',
                'calle' => 'Calle 4',
                'codigoPostal' => '39000',
                'telefono' => '4777849632',
                'celular' => '47772103126'
            ],
            [
                'id' => 5,
                'nombre' => 'Jose Rodriguez',
                'colonia' => 'Colonia 5',
                'calle' => 'Calle 5',
                'codigoPostal' => '39500',
                'telefono' => '47710320060',
                'celular' => '4779512450'
            ],
            [
                'id' => 6,
                'nombre' => 'Marco Diaz',
                'colonia' => 'Colonia 6',
                'calle' => 'Calle 6',
                'codigoPostal' => '40000',
                'telefono' => '4779638521',
                'celular' => '4771472583'
            ]

        ]);
    }
}
