<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaqueteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 25);
            $table->string('imgNombreVirtual')->nullable();
            $table->string('imgNombreFisico')->nullable();
            $table->double("precio", 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete');
    }
}
