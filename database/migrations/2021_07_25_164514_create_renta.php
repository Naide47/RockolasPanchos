<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idUsuario')->references('id')->on('usuario');
            $table->foreignId('idCliente')->references('id')->on('cliente');
            $table->integer('total');
            $table->integer('anticipoPagado');
            $table->date('fechaRegistro');
            $table->date('fechaInicio')->format('d-m-Y');
            $table->date('fechaTermino')->format('d-m-Y');
            $table->string('noTarjeta');
            $table->string('tipoTarjeta');
            $table->integer('estatus');

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
        Schema::dropIfExists('renta');
    }
}
