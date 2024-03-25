<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBairroEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bairro_estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("estabelecimento_id")->unsigned();
            $table->bigInteger("bairro_id")->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
            $table->foreign('bairro_id')->references('id')->on('bairros');
            $table->double("distancia", 8, 2)->nullable();
            $table->double('valor_entrega', 8, 2)->nullable();
            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('bairro_estabelecimentos');
    }
}
