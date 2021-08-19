<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePaqueteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_paquete', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("paquete_id");
            $table->unsignedBigInteger("producto_id");
            $table->integer("cantidad");

            $table->foreign("paquete_id")->references("id")->on("paquete");
            $table->foreign("producto_id")->references("id")->on("producto");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_paquete');
    }
}
