<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPagamentoEstabelecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagamento_estabelecimentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("estabelecimento_id")->unsigned();
            $table->bigInteger("forma_pagamento_id")->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos');
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
        Schema::dropIfExists('forma_pagamento_estabelecimentos');
    }
}
