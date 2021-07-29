<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venta', function (Blueprint $table) {
            $table->dropForeign('cliente_id');
            $table->dropForeign('users_id');
        });
    }
}
