<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tela;
use App\Models\PerfilTela;
use Illuminate\Support\Facades\DB;

class AssociarTelasAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Associa todas as telas ao perfil super admin
        foreach(Tela::all() as $tela) {
            PerfilTela::create([
                "tela_id" => $tela->id,
                "perfil_id" => 1,
                "created_at" => new \DateTime("now")
            ]);
        }

        // permissão estabelecimentos
        foreach(DB::table('telas')->whereIn("id", [61, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 118, 119, 120, 121, 122, 123, 124])->get() as $tela) {
            PerfilTela::create([
                "tela_id" => $tela->id,
                "perfil_id" => 2,
                "created_at" => new \DateTime("now")
            ]);
        }

        // permissão cliente
        foreach(DB::table('telas')->whereIn("id", [61, 118, 119, 120, 121, 122, 123, 124])->get() as $tela) {
            PerfilTela::create([
                "tela_id" => $tela->id,
                "perfil_id" => 3,
                "created_at" => new \DateTime("now")
            ]);
        }
    }
}
