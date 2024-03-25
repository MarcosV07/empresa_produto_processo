<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracao;
use App\Models\Tela;

class ConfiguracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados iniciais
        Configuracao::create(["chave" => "ID_PERFIL_ADMIN", "valor" => 1, "descricao" => "Identificador do perfil super admin."]);
        Configuracao::create(["chave" => "ID_PERFIL_ESTABELECIMENTO", "valor" => 2, "descricao" => "Identificador do estabelecimento."]);
        Configuracao::create(["chave" => "ID_PERFIL_CLIENTE", "valor" => 3, "descricao" => "Identificador do cliente."]);
        Configuracao::create(["chave" => "VALOR_SALDO_INICIAL_CLIENTE", "valor" => 1000, "descricao" => "Valor inicial de saldo ao cadastrar um novo cliente."]);

        // Rotas
        Tela::create(["nome" => "Configurações", "rota" => "configuracao.index", "icone" => "far fa-cog", "menu" => true, "modulo_id" => 3, "ordem" => 1]);
        Tela::create(["nome" => "Cadastrar Configuração", "rota" => "configuracao.store", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de criaçao de Configuração", "rota" => "configuracao.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Configuração", "rota" => "configuracao.update", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Exclusão de Configuração", "rota" => "configuracao.destroy", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Formulário de edição de Configuração", "rota" => "configuracao.edit", "icone" => null, "menu" => false]);
    }
}
