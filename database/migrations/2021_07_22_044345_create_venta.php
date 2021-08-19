<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->default(0);
            $table->unsignedBigInteger('users_id')->default(0);
            $table->decimal('total', 13, 2)->default(0);
            $table->decimal('anticipoPagado', 13, 2)->default(0);
            $table->timestamp('fechaRegistro')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('status')->default(0);
            $table->timestamps();

            // $table->foreign('cliente_id')->references('id')->on('cliente');
            // $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
