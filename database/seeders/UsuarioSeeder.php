<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 0,
                "name" => "null",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 0,
                "email" => '885FE50722A118BEBD817C0960F93021AC7684E38D9C8BC6A58F818E25E90F2D',
                'password' => bcrypt('A0FCBE9152B3FA32A352E0ECC2DAA5B1F8D28227E63348FFDF33C258C7B0E0ED'),
                'rol_id' => 1, //Vendedor
            ],
            [
                'id' => 1,
                "name" => "Juan Martinez",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 1,
                "email" => 'juan_m@email.com',
                'password' => bcrypt('juan123'),
                'rol_id' => 1, //Vendedor
            ],
            [
                'id' => 2,
                "name" => "Alejandro Rodriguez",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 2,
                "email" => 'alejandro_r@email.com',
                'password' => bcrypt('alejandro123'),
                'rol_id' => 2, //Encargado
            ],
            [
                'id' => 3,
                "name" => "Marta Salazar",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 3,
                "email" => 'marta_s@email.com',
                'password' => bcrypt('marta123'),
                'rol_id' => 3, // Gerente
            ],
            [
                'id' => 4,
                "name" => "Cecilia Alcantar",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 4,
                "email" => 'cecilia_a@email.com',
                'password' => bcrypt('cecilia123'),
                'rol_id' => 1, // Vendedor
            ],
            [
                'id' => 5,
                "name" => "Jose Rodriguez",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 5,
                "email" => 'jose_r@email.com',
                'password' => bcrypt('jose1234'),
                'rol_id' => 2, //Encargado
            ],
            [
                'id' => 6,
                "name" => "Marco Diaz",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                "persona_id" => 6,
                "email" => 'marco_d@email.com',
                'password' => bcrypt('marco123'),
                'rol_id' => 3, // Gerente
            ]
        ]);
    }
}
