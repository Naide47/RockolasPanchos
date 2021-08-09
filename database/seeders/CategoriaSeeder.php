<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            ["id" => 1, "categoria" => "Silla"],
            ["id" => 2, "categoria" => "Mesa"],
            ["id" => 3, "categoria" => "Rockola"],
            ["id" => 4, "categoria" => "Carpa"],
            ["id" => 5, "categoria" => "Inflable"]
        ]);
    }
}
