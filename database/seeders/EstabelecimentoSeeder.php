<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;

class EstabelecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create(["nome" => "Estabelecimentos", "rota" => "estabelecimento.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 1, "ordem" => 1]);
        Tela::create(["nome" => "Cadastrar Estabelecimentos", "rota" => "estabelecimento.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Estabelecimentos", "rota" => "estabelecimento.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Estabelecimentos", "rota" => "estabelecimento.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Estabelecimentos", "rota" => "estabelecimento.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Estabelecimentos", "rota" => "estabelecimento.edit", "icone" => null, "menu" => false]);
    }
}
