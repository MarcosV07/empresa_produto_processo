<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;
use App\Models\Tela;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados iniciais
        Modulo::create(["nome" => "Estabelecimentos"]);
        Modulo::create(["nome" => "Loja"]);
        Modulo::create(["nome" => "Configurações"]);

        // Rotas
        Tela::create(["nome" => "Modulos", "rota" => "modulo.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Modulo", "rota" => "modulo.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Modulo", "rota" => "modulo.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Modulo", "rota" => "modulo.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Modulo", "rota" => "modulo.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Modulo", "rota" => "modulo.edit", "icone" => null, "menu" => false]);
    }
}
