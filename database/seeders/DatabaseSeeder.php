<?php

namespace Database\Seeders;

// php artisan migrate:fresh --seed

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        $this->call(RolSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ProductoSeeder::class);

    }
}
