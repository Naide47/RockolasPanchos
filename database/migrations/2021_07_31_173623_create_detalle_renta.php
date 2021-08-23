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
            $table->unsignedBigInteger('renta_id');
            $table->unsignedBigInteger('producto_id');            
            $table->integer('cantidad');
            $table->integer('precioUnitario');

            $table->foreign('renta_id')->references('id')->on('renta');
            $table->foreign('producto_id')->references('id')->on('producto');
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
