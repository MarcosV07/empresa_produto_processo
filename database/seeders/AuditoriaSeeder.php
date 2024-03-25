<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tela;

class AuditoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rotas
        Tela::create(["nome" => "Auditoria", "rota" => "auditoria.index", "icone" => "fas fa-gavel", "menu" => true, "ordem" => 2, "modulo_id" => 3]);

        // Auditar todas as rotas de UPDATE, INSERT E DELETE
        Tela::where("rota", "like", "%update%")
            ->orWhere("rota", "like", "%store%")
            ->orWhere("rota", "like", "%destroy%")
            ->update(["auditoria" => true]);
    }
}
