<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->id("idUsuario");
            $table->unsignedBigInteger("idPersona");
            $table->unsignedBigInteger("idRol");
            $table->tinyInteger("estatus")->default("1");
            $table->dropColumn("name");

            $table->foreign("idPersona")->references("idPersona")->on("personas");
            $table->foreign("idRol")->references("idRol")->on("roles");
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(["idPersona"]);
            $table->dropForeign(["idRol"]);

            $table->dropColumn("idPersona");
            $table->dropColumn("idRol");
            $table->dropColumn("estatus");
        });
    }
}
