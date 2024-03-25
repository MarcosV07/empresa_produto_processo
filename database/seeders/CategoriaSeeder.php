<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Categoria;
use \App\Models\Tela;
  
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(["nome" => "Supermercado", "descricao" => " "]);
        Categoria::create(["nome" => "Tecnologia", "descricao" => " "]);
        Categoria::create(["nome" => "Roupa", "descricao" => " "]);
        Categoria::create(["nome" => "Veículo", "descricao" => " "]);

        Tela::create(["nome" => "Categoria do Estabelecimento", "rota" => "categoria.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 1, "ordem" => 2]);
        Tela::create(["nome" => "Cadastrar Categoria", "rota" => "categoria.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de categoria", "rota" => "categoria.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Categoria", "rota" => "categoria.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Categoria", "rota" => "categoria.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Categoria", "rota" => "categoria.edit", "icone" => null, "menu" => false]);
    }
}
