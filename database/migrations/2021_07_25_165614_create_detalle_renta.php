<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleRenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_renta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idRenta')->references('id')->on('renta');
            $table->foreignId('idProducto')->references('id')->on('producto');
            $table->integer('cantidad');
            $table->integer('precioUnitario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_renta');
    }
}
