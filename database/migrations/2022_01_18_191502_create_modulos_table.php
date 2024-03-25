<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 50);
            $table->timestamps();
        });

        Schema::table('telas', function (Blueprint $table) {
            $table->bigInteger("modulo_id")->nullable()->unsigned();
            $table->foreign('modulo_id')->references('id')->on('modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telas', function (Blueprint $table) {
            $table->dropForeign('telas_modulo_id_foreign');
            $table->dropColumn("modulo_id");
        });

        Schema::dropIfExists('modulos');
    }
}
