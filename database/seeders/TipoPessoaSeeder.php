<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\TipoPessoa;
use \App\Models\Tela;

class TipoPessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPessoa::create(["nome" => "Física"]);
        TipoPessoa::create(["nome" => "Jurídica"]);

        Tela::create(["nome" => "Tipo de Pessoa", "rota" => "tipo-pessoa.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Tipo de Pessoa", "rota" => "tipo-pessoa.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Tipo de Pessoa", "rota" => "tipo-pessoa.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Tipo de Pessoa", "rota" => "tipo-pessoa.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Tipo de Pessoa", "rota" => "tipo-pessoa.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Tipo de Pessoa", "rota" => "tipo-pessoa.edit", "icone" => null, "menu" => false]);
    }
}
