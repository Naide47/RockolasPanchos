<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCategoria')->references('id')->on('categoria');
            $table->string('nombre');
            $table->integer('existencias');
            $table->integer('disponibles');
            $table->double('precioCompra');
            $table->double('precioUnitario');
            $table->string('rutaFoto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
