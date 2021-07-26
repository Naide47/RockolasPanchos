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
            $table->unsignedBigInteger('categoria_id')->default(0);
            $table->foreign('categoria_id')->references('id')->on('categoria');
            $table->string('nombre', 50);
            $table->integer('existencia')->default(0);
            $table->integer('disponibles')->default(0);
            $table->decimal('precioCompra', 13, 2)->default(0);
            $table->decimal('precioUnitario', 13, 2)->default(0);
            $table->string('rutaFoto', 50);
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
        Schema::dropIfExists('producto');
    }
}
