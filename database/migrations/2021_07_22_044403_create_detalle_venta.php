<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id')->default(0);
            $table->foreign('venta_id')->references('id')->on('venta');
            $table->unsignedBigInteger('producto_id')->default(0);
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->default(0);
            $table->decimal('precioUnitario', 13, 2)->default(0);
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
        Schema::dropIfExists('detalle_venta');
    }
}
