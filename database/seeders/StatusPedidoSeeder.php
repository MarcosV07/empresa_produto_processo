<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusPedido;
use App\Models\Tela;

class StatusPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPedido::create(["nome" => "Pedido Solicitado"]);
        StatusPedido::create(["nome" => "Entregar Pedido"]);
        StatusPedido::create(["nome" => "Pedido Finalizado"]);
        StatusPedido::create(["nome" => "Pedido Cancelado"]);

        Tela::create(["nome" => "Status Pedido", "rota" => "status-pedido.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 2, "ordem" => 4]);
        Tela::create(["nome" => "Cadastrar Status do Pedido", "rota" => "status-pedido.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Status do Pedido", "rota" => "status-pedido.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Status do Pedido", "rota" => "status-pedido.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Status do Pedido", "rota" => "status-pedido.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição do Status do Pedido", "rota" => "status-pedido.edit", "icone" => null, "menu" => false]);

        Tela::create(["nome" => "Cliente", "rota" => "cliente.index", "icone" => "far fa-circle", "menu" => true]);
        Tela::create(["nome" => "Cadastrar Cliente", "rota" => "cliente.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criação de Cliente", "rota" => "cliente.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Cliente", "rota" => "cliente.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Cliente", "rota" => "cliente.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição do Cliente", "rota" => "cliente.edit", "icone" => null, "menu" => false]);

        Tela::create(["nome" => "Pedido", "rota" => "pedido.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 2, "ordem" => 3]);
        Tela::create(["nome" => "Cadastrar Pedido", "rota" => "pedido.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criação de Pedido", "rota" => "pedido.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Pedido", "rota" => "pedido.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Pedido", "rota" => "pedido.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição do Pedido", "rota" => "pedido.edit", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Cadastrar pedido Cliente", "rota" => "pedido.loja", "icone" => null, "menu" => false]);
    }
}
