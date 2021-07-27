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
            $table->unsignedBigInteger("persona_id");
            $table->unsignedBigInteger("rol_id");
            $table->tinyInteger("estatus")->default("1");

            $table->foreign("persona_id")->references("id")->on("persona");
            $table->foreign("rol_id")->references("id")->on("rol");
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
