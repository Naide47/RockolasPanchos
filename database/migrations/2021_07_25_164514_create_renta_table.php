<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentaTable extends Migration
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
            $table->date('fechaTermino')->format('d-m-Y');
            $table->string('noTarjeta');
            $table->string('tipoTarjeta');
            $table->integer('estatus');
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
