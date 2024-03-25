<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\TipoFormaPagamento;
use \App\Models\Tela;

class TipoFormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoFormaPagamento::create(["nome" => "Crédito"]);
        TipoFormaPagamento::create(["nome" => "Débito"]);
        TipoFormaPagamento::create(["nome" => "Outros"]);
        TipoFormaPagamento::create(["nome" => "Vale-refeição"]);

        Tela::create(["nome" => "Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Tipo Forma Pagamento", "rota" => "tipo-forma-pagamento.edit", "icone" => null, "menu" => false]);
    }
}
