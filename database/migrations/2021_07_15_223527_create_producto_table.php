<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
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
            // $table->foreignId("idCategoria")->constrained("categoria", 'idCategoria');
            $table->unsignedBigInteger('categoria_id');
            $table->string("nombre", 50)->unique();
            $table->integer("existencias");
            $table->integer("disponibles");
            $table->double("precioCompra");
            $table->double("precioUnitario");
            // $table->string("rutaFoto", 260)->nullable();
            $table->string('imgNombreVirtual')->nullable();
            $table->string('imgNombreFisico')->nullable();


            $table->foreign('categoria_id')->references('id')->on('categoria');
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
