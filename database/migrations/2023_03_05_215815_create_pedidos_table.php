<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("estabelecimento_id")->unsigned();
            $table->bigInteger("produto_id")->unsigned();            
            $table->bigInteger("cliente_id")->unsigned();
            $table->bigInteger("status_pedido_id")->unsigned();
            $table->double('valor_pedido', 8, 2);  
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('status_pedido_id')->references('id')->on('status_pedidos');
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
        Schema::dropIfExists('pedidos');
    }
}
