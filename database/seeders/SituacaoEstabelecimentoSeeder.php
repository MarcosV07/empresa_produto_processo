<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\SituacaoEstabelecimento;
use \App\Models\Tela;

class SituacaoEstabelecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SituacaoEstabelecimento::create(["nome" => "Ativo"]);
        SituacaoEstabelecimento::create(["nome" => "Inativo"]);

        Tela::create(["nome" => "Situações de Estabelecimento", "rota" => "situacao-estabelecimento.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 1, "ordem" => 3]);
        Tela::create(["nome" => "Cadastrar Situação de Estabelecimento", "rota" => "situacao-estabelecimento.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Situação de Estabelecimento", "rota" => "situacao-estabelecimento.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Situação de Estabelecimento", "rota" => "situacao-estabelecimento.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Situação de Estabelecimento", "rota" => "situacao-estabelecimento.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Situação de Estabelecimento", "rota" => "situacao-estabelecimento.edit", "icone" => null, "menu" => false]);
    }
}
