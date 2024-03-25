<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ModuloSeeder::class);
        $this->call(TelaSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(PerfilTelaSeeder::class);
        $this->call(DiaSeeder::class);
        $this->call(ConfiguracaoSeeder::class);
        $this->call(TipoFormaPagamentoSeeder::class);
        $this->call(FormaPagamentoSeeder::class);
        $this->call(BairroSeeder::class);
        $this->call(EnderecoSeeder::class);
        $this->call(EstabelecimentoSeeder::class);
        $this->call(IconesModuloTelaPainelControleSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SituacaoEstabelecimentoSeeder::class);
        $this->call(TipoPessoaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(ValorDistanciaSeeder::class);
        $this->call(CategoriaProdutoSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(StatusPedidoSeeder::class);
        $this->call(AuditoriaSeeder::class);
        $this->call(AjusteOrdemIconeMenu1Seeder::class);
        $this->call(AssociarTelasAdminSeeder::class);  
    }
}
