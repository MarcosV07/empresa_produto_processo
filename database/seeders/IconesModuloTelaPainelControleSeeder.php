<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;
use App\Models\Tela;

class IconesModuloTelaPainelControleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::where("id", 1)->update(["icone" => "fas fa-building", "ordem" => 1]);
        Modulo::where("id", 2)->update(["icone" => "fas fa-solid fa-store", "ordem" => 3]);
        Modulo::where("id", 3)->update(["icone" => "fas fa-cog", "ordem" => 2]);

        Tela::create(["nome" => "Painel de Controle", "rota" => "home", "menu" => true, "icone" => "far fa-fw fa-circle"]);
    }
}
