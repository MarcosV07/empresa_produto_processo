<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("estabelecimento_id")->unsigned();
            $table->bigInteger("dia_id")->unsigned();
            $table->time("horario_inicio");
            $table->time("horario_fim");
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
            $table->foreign('dia_id')->references('id')->on('dias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dia_estabelecimentos');
    }
}
