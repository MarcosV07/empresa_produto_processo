<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_produtos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 50);
            $table->timestamps();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 50);
            $table->double('valor', 8, 2);
            $table->bigInteger("estabelecimento_id")->unsigned();
            $table->bigInteger("categoria_produto_id")->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
            $table->foreign('categoria_produto_id')->references('id')->on('categoria_produtos');
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
        Schema::dropIfExists('categoria_produtos');
        Schema::dropIfExists('produtos');
    }
}
