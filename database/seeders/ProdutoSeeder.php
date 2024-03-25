<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create(["nome" => "Produto", "rota" => "produto.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 2, "ordem" => 1]);
        Tela::create(["nome" => "Cadastrar Produto", "rota" => "produto.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Produto", "rota" => "produto.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Produto", "rota" => "produto.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Produto", "rota" => "produto.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Produto", "rota" => "produto.edit", "icone" => null, "menu" => false]);
    }
}
