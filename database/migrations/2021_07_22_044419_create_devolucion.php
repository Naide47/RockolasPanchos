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
            $table->unsignedBigInteger('venta_id')->default(0);
            $table->string('descripcion', 100);
            $table->decimal('devuelto', 13, 2)->default(0);
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
