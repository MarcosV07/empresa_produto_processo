<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->bigInteger("tipo_pessoa_id")->unsigned();
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipo_pessoas');
            $table->string("numero_documento", 50);
            $table->string("razao_social", 200)->nullable();
            $table->string("nome_fantasia", 100)->nullable();
            $table->bigInteger("categoria_id")->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string("email", 100);
            $table->string("telefone", 20)->nullable();
            $table->string("whatsapp", 20)->nullable();
            $table->string("nome_contato", 100)->nullable();
            $table->string("cep", 10);
            $table->string("logradouro", 200);
            $table->string("bairro", 200);
            $table->string("estado", 50);
            $table->string("cidade", 100);
            $table->string("numero", 5);
            $table->string("complemento", 255)->nullable();
            $table->string("referencia", 255)->nullable();
            $table->string("descricao", 200)->nullable();
            $table->bigInteger("situacao_estabelecimento_id")->unsigned();
            $table->foreign('situacao_estabelecimento_id')->references('id')->on('situacao_estabelecimentos');
            $table->string("logotipo", 255)->nullable();
            $table->string("fundo_cabecalho", 255)->nullable();
            $table->double('valor_minimo_pedido', 8, 2)->nullable()->default(0.00);
            $table->boolean('permite_retirada')->default(false);
            $table->string("latitude", 50)->nullable();
            $table->string("longitude", 50)->nullable();
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
        Schema::dropIfExists('estabelecimentos');
    }
}
