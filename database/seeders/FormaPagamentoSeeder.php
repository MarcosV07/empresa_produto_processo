<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\FormaPagamento;
use \App\Models\Tela;

class FormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormaPagamento::create(["nome" => "Visa", "tipo_forma_pagamento_id" => 1]);
        FormaPagamento::create(["nome" => "Master", "tipo_forma_pagamento_id" => 1]);

        Tela::create(["nome" => "Forma de Pagamento", "rota" => "forma-pagamento.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Forma de Pagamento", "rota" => "forma-pagamento.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Forma de Pagamento", "rota" => "forma-pagamento.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Forma de Pagamento", "rota" => "forma-pagamento.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Forma de Pagamento", "rota" => "forma-pagamento.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Forma de Pagamento", "rota" => "forma-pagamento.edit", "icone" => null, "menu" => false]);
    }
}
