<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfil;
use App\Models\Tela;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados iniciais
        Perfil::create(["nome" => "Administrador"]);
        Perfil::create(["nome" => "Estabelecimento"]);
        Perfil::create(["nome" => "Cliente"]);

        // Rotas
        Tela::create(["nome" => "Perfis", "rota" => "perfil.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 3, "ordem" => 2]);
        Tela::create(["nome" => "Cadastrar Perfil", "rota" => "perfil.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Perfil", "rota" => "perfil.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Perfil", "rota" => "perfil.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Perfil", "rota" => "perfil.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Perfil", "rota" => "perfil.edit", "icone" => null, "menu" => false]);
    }
}
