<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tela;

class PerfilTelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create(["nome" => "Perfis x Telas", "rota" => "perfil-tela.index", "icone" => "far fa-circle", "menu" => true, "modulo_id" => 3, "ordem" => 3]);
        Tela::create(["nome" => "Associção (Perfis x Telas)", "rota" => "perfil-tela.associacao", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Associar (Perfis x Telas)", "rota" => "perfil-tela.associar", "icone" => null, "menu" => false]);        
    }
}
