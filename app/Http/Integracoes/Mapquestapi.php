<?php

namespace App\Http\Integracoes;

use Illuminate\Support\Facades\Http;
use App\Models\Configuracao;

class Mapquestapi {

    protected $apiKey;

    public function __construct()
    {
        $configuracao = Configuracao::where("chave", "CHAVE_API_MAPQUEST")->first();

        if(!empty($configuracao)) {
            $this->apiKey = $configuracao->valor;
        }
    }

    public function obterDirecoes($localizacoes) {
        
        $retorno = [
            "ok" => true,
            "distancias" => [],
            "msgErro"
        ];

        $url = "http://open.mapquestapi.com/directions/v2/routematrix?key=" . $this->apiKey;
        $dados = [
            'locations' => $localizacoes,
            'options' => [
                "allToAll" => false
            ]
        ];
        
        $response = Http::acceptJson()->post($url, $dados);
        if($response->ok()) {
            $retornoMapquest = json_decode($response->body());
            if(isset($retornoMapquest->distance)) {
                $retorno["distancias"] = $retornoMapquest->distance;
            }
        } else {
            $retorno["ok"] = false;
            $retorno["msgErro"] = $response->body();
        }

        return $retorno;
    }
}