<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Endereco;
use \App\Models\Bairro;
use \App\Models\Tela;
use Illuminate\Support\Facades\Http;

class BairroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tela::create(["nome" => "Bairros", "rota" => "bairro.index", "icone" => "far fa-circle", "menu" => false]);
        Tela::create(["nome" => "Cadastrar Bairro", "rota" => "bairro.store", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de criaçao de Bairro", "rota" => "bairro.create", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Atualizar Bairro", "rota" => "bairro.update", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Exclusão de Bairro", "rota" => "bairro.destroy", "icone" => null, "menu" => false, "auditoria" => true]);
        Tela::create(["nome" => "Formulário de edição de Bairro", "rota" => "bairro.edit", "icone" => null, "menu" => false]);
        Tela::create(["nome" => "Obter localização estabelecimento", "rota" => "bairro.obterLatitudeLongitude", "icone" => null, "menu" => false]);

        // Habilitando os bairros somente de Salvador
        $estado = "SP";
        $cidade = "Ribeirão Preto";

        $enderecos = Endereco::select(["estado", "cidade", "bairro"])
            ->groupBy("estado", "cidade", "bairro")
            ->where(["estado" => $estado, "cidade" => $cidade])
            ->get();

        // Tratamento adicionado para evitar a duplicidade de bairros durante a execução do semeador
        $bairrosEstadoCidade = Bairro::where(["estado" => $estado, "cidade" => $cidade])->count();
        if($bairrosEstadoCidade == 0) {
            foreach($enderecos as $endereco) {
                if(!empty($endereco->estado)
                && !empty($endereco->cidade)
                && !empty($endereco->bairro)) {
    
                    // Trecho implementado para obter a latitude de longitude do bairro via API da Nominatim
                    $pesquisa = urlencode($endereco->bairro . "," . $endereco->cidade . "," . $endereco->estado);
                    $urlNominatim = "https://nominatim.openstreetmap.org/search.php?q=" . $pesquisa . "&format=jsonv2";
                    $response = Http::get($urlNominatim);
                    
                    $latitude = 0;
                    $longitude = 0;
    
                    if($response->ok()) {
                        $retornoNominatim = json_decode($response->body());
                        if(isset($retornoNominatim[0]->lat)) {
                            $latitude = $retornoNominatim[0]->lat;
                        }
    
                        if(isset($retornoNominatim[0]->lon)) {
                            $longitude = $retornoNominatim[0]->lon;
                        }
                    }
    
                    Bairro::create([
                        "estado" => $endereco->estado,
                        "cidade" => $endereco->cidade,
                        "bairro" => $endereco->bairro,
                        "latitude" => $latitude,
                        "longitude" => $longitude
                    ]);
                }
            }
        }
    }
}
