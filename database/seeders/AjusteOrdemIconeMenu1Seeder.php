<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;

class AjusteOrdemIconeMenu1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Módulo de Acesso e Segurança
        Tela::where("rota", "usuario.index")->update(["icone" => "fas fa-users", "ordem" => 7]);
        Tela::where("rota", "cliente.index")->update(["icone" => "fas fa-solid fa-user", "ordem" => 8]);
        /*
        Tela::where("rota", "tela.index")->update(["ordem" => 3]);
        Tela::where("rota", "perfil-tela.index")->update(["ordem" => 4]);
        Tela::where("rota", "modulo.index")->update(["ordem" => 5]);
        Tela::where("rota", "perfil.index")->update(["ordem" => 6]);
        Tela::where("rota", "home")->update(["ordem" => 1, "icone" => "fas fa-chart-pie"]);*/
    }
}
