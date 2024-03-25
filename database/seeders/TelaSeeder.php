<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tela;

class TelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create(["nome" => "Home", "rota" => "home", "menu" => false]);
        Tela::create(["nome" => "Listagem de telas", "rota" => "tela.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 3, "ordem" => 4]);
        Tela::create(["nome" => "Cadastrar Tela", "rota" => "tela.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Tela", "rota" => "tela.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exibição de Tela", "rota" => "tela.show", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Tela", "rota" => "tela.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Tela", "rota" => "tela.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Tela", "rota" => "tela.edit", "icone" => null, "menu" => false]);

    }
}
