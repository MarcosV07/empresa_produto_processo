<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;
use \App\Models\Dia;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dia::create(["nome" => "Segunda-feira"]);
        Dia::create(["nome" => "Terça-feira"]);
        Dia::create(["nome" => "Quarta-feira"]);
        Dia::create(["nome" => "Quinta-feira"]);
        Dia::create(["nome" => "Sexta-feira"]);
        Dia::create(["nome" => "Sábado"]);
        Dia::create(["nome" => "Domingo"]);

        Tela::create(["nome" => "Dias", "rota" => "dia.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Dia", "rota" => "dia.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Dia", "rota" => "dia.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Dia", "rota" => "dia.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Dia", "rota" => "dia.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Dia", "rota" => "dia.edit", "icone" => null, "menu" => false]);
    }
}
