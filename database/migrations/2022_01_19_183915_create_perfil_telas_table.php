<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilTelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfis_telas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("tela_id")->unsigned();
            $table->bigInteger("perfil_id")->unsigned();
            $table->timestamps();
            $table->foreign('tela_id')->references('id')->on('telas');
            $table->foreign('perfil_id')->references('id')->on('perfis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfis_telas', function (Blueprint $table) {
            $table->dropForeign('perfis_telas_tela_id_foreign');
            $table->dropForeign('perfis_telas_perfil_id_foreign');
        });

        Schema::dropIfExists('perfis_telas');
    }
}
