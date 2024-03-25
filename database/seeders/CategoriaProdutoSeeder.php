<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\CategoriaProduto;
use \App\Models\Tela;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaProduto::create(["nome" => "Roupa"]);
        CategoriaProduto::create(["nome" => "Briquedos"]);

        Tela::create(["nome" => "Categoria de Produto", "rota" => "categoria-produto.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 2, "ordem" => 2]);
        Tela::create(["nome" => "Cadastrar Categoria de Produto", "rota" => "categoria-produto.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de categoria de produto", "rota" => "categoria-produto.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Categoria do Produto", "rota" => "categoria-produto.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Categoria do Produto", "rota" => "categoria-produto.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Categoria de Produto", "rota" => "categoria-produto.edit", "icone" => null, "menu" => false]);
    }
}
