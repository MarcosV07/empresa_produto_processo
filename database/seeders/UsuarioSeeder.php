<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;
use \App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rotas
        Tela::create(["nome" => "Usuários", "rota" => "usuario.index", "icone" => "fas fa-users", "menu" => true]);
        Tela::create(["nome" => "Cadastrar Usuário", "rota" => "usuario.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Usuário", "rota" => "usuario.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Usuário", "rota" => "usuario.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Usuário", "rota" => "usuario.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Usuário", "rota" => "usuario.edit", "icone" => null, "menu" => false]);

        // Ativação / Inativação de usuário para permissão de login na aplicação
        Tela::create(["nome" => "Ativação de usuário", "rota" => "usuario.ativar", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Desativação de usuário", "rota" => "usuario.desativar", "icone" => null, "menu" => false]);

        // Criação de usuário padrão da aplicação tendo perfil super admin
        Usuario::create([
            "name" => "Admin",
            "email" => "marcos@sebrae.com.br",
            "email_verified_at" => new \DateTime("now"),
            "password" => bcrypt("admin"),
            "created_at"=> new \DateTime("now"),
            "perfil_id" => 1,
            "ativo" => true,
            "estabelecimento_id" => null
        ]);
    }
}
