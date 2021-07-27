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
            ["categoria"=>"Silla"],
            ["categoria"=>"Mesa"],
            ["categoria"=>"Rockola"],
            ["categoria"=>"Carpa"],
            ["categoria"=>"Inflable"]
        ]);
    }
}
