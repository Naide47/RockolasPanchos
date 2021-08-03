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

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            
            $table->integer('total');
            $table->integer('anticipoPagado');
            $table->date('fechaRegistro');
            $table->date('fechaInicio')->format('d-m-Y');
            #$table->time('horaRecogida');
            $table->date('fechaTermino')->format('d-m-Y');
            $table->string('noTarjeta');
            $table->string('tipoTarjeta');
            $table->integer('estatus');

            $table->string('calle');
            $table->string('colonia');
            $table->string('noexterior');

	        $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cliente_id')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renta');
    }
}
