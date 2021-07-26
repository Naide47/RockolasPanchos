<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->default(0);
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('usuario_id')->default(0);
            $table->foreign('usuario_id')->references('id')->on('usuario');
            $table->decimal('total', 13, 2)->default(0);
            $table->decimal('anticipoPagado', 13, 2)->default(0);
            $table->date('fechaRegistro');
            $table->integer('noTarjetaa')->default(0);
            $table->integer('tipoTarjeta')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('venta');
    }
}
