<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id("idProducto");
            // $table->foreignId("idCategoria")->constrained("categoria", 'idCategoria');
            $table->unsignedBigInteger('idCategoria');
            $table->string("nombre", 50);
            $table->integer("existencias");
            $table->integer("disponibles");
            $table->double("precioCompra");
            $table->double("precioUnitario");
            $table->string("rutaFoto", 260)->nullable();
            // $table->string('imgNombreVirtual')->nullable();
            // $table->string('imgNombreFisico')->nullable();


            $table->foreign('idCategoria')->references('idCategoria')->on('categoria');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
