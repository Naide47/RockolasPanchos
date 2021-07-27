<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //`persona`(`id`, `nombre`, `colonia`, `calle`, `codigoPostal`, `telefono`, `celular`)
        Schema::create('persona', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('colonia');
            $table->string('calle');
            $table->string('codigoPostal');
            $table->string('telefono');
            $table->string('celular');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
