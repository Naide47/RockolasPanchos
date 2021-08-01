<?php

namespace Database\Seeders;

// php artisan migrate:fresh --seed

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ProductoSeeder::class);

    }
}
