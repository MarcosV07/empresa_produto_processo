<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tela;
use \App\Models\ValorDistancia;

class ValorDistanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rotas
        Tela::create(["nome" => "Valor x Distância(Km)", "rota" => "valor-distancia.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Valor x Distância(Km)", "rota" => "valor-distancia.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Valor x Distância(Km)", "rota" => "valor-distancia.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Valor x Distância(Km)", "rota" => "valor-distancia.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Valor x Distância(Km)", "rota" => "valor-distancia.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Valor x Distância(Km)", "rota" => "valor-distancia.edit", "icone" => null, "menu" => false]);

        // Exemplos de faixa de valor
        ValorDistancia::create(["km_inicial" => 0, "km_final" => 1, "valor" => 4.00]);
        ValorDistancia::create(["km_inicial" => 1, "km_final" => 2, "valor" => 5.00]);
        ValorDistancia::create(["km_inicial" => 2, "km_final" => 3, "valor" => 6.00]);
        ValorDistancia::create(["km_inicial" => 3, "km_final" => 4, "valor" => 7.00]);
        ValorDistancia::create(["km_inicial" => 4, "km_final" => 5, "valor" => 8.00]);
        ValorDistancia::create(["km_inicial" => 5, "km_final" => 6, "valor" => 9.00]);
        ValorDistancia::create(["km_inicial" => 6, "km_final" => 7, "valor" => 10.00]);
        ValorDistancia::create(["km_inicial" => 7, "km_final" => 8, "valor" => 11.00]);
        ValorDistancia::create(["km_inicial" => 8, "km_final" => 9, "valor" => 12.00]);
        ValorDistancia::create(["km_inicial" => 9, "km_final" => 10, "valor" => 13.00]);
        ValorDistancia::create(["km_inicial" => 10, "km_final" => 11, "valor" => 14.00]);
        ValorDistancia::create(["km_inicial" => 11, "km_final" => 12, "valor" => 15.00]);
        ValorDistancia::create(["km_inicial" => 12, "km_final" => 13, "valor" => 16.00]);
        ValorDistancia::create(["km_inicial" => 13, "km_final" => 14, "valor" => 17.00]);
        ValorDistancia::create(["km_inicial" => 14, "km_final" => 15, "valor" => 18.00]);
        ValorDistancia::create(["km_inicial" => 15, "km_final" => 16, "valor" => 19.00]);
        ValorDistancia::create(["km_inicial" => 16, "km_final" => 17, "valor" => 20.00]);
        ValorDistancia::create(["km_inicial" => 17, "km_final" => 18, "valor" => 21.00]);
        ValorDistancia::create(["km_inicial" => 18, "km_final" => 19, "valor" => 22.00]);
        ValorDistancia::create(["km_inicial" => 19, "km_final" => 20, "valor" => 23.00]);
        ValorDistancia::create(["km_inicial" => 20, "km_final" => 21, "valor" => 24.00]);
        ValorDistancia::create(["km_inicial" => 21, "km_final" => 22, "valor" => 25.00]);
    }
}
