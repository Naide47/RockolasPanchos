<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucion', function (Blueprint $table) {
            $table->id();
            $table->string('venta_identificador')->default(0);
            $table->string('cliente', 150);
            $table->string('celular', 100);
            $table->string('producto', 100);
            $table->integer('cantidad')->default(0);
            $table->string('descripcion', 100);
            // $table->timestamps();
            // $table->foreign('venta_id')->references('id')->on('venta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devolucion');
    }
}
