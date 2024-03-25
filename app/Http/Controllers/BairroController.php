<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bairro;
use App\Http\Integracoes\Mapquestapi;
use App\Models\ValorDistancia;
use App\Models\BairroEstabelecimento;
use App\Http\Requests\StoreBairroRequest;
use GuzzleHttp\Client;

class BairroController extends Controller
{
    protected $mapquestApi;

    public function __construct() {
        $this->mapquestApi = new Mapquestapi();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bairros = Bairro::orderBy("id", "desc")->paginate(20);
        return view("bairro.index", ["bairros" => $bairros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("bairro.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBairroRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBairroRequest $request)
    {
        Bairro::create($request->all());
        toastr()->success('Bairro cadastrado com sucesso');
        return redirect()->route("bairro.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bairro  $bairro
     * @return \Illuminate\Http\Response
     */
    public function edit(Bairro $bairro)
    {
        return view("bairro.create", ["bairro" => $bairro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreBairroRequest $request
     * @param  \App\Models\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBairroRequest $request, Bairro $bairro)
    {
        $bairro->update($request->all());
        toastr()->success('Bairro alterado com sucesso');
        return redirect()->route("bairro.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bairro $bairro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bairro $bairro)
    {
        $bairro->delete();
        toastr()->success('Bairro excluído com sucesso');
        return redirect()->route("bairro.index");
    }

    public function obterBairrosPorCidade(Request $request) {

        $retorno = [
            "ok" => true,
            "msg" => "",
            "bairros" => [],
            "valoresBairros" => []
        ];

        try {
            
            $estado = $request->estado;
            $cidade = $request->cidade;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $idEstabelecimento = $request->idEstabelecimento;
            
            if(empty($estado)) {
                throw new \Exception("Estado não informado.");
            }

            if(empty($cidade)) {
                throw new \Exception("Cidade não informada.");
            }

            if(empty($latitude)) {
                throw new \Exception("Latitude do estabelecimento não informada.");
            }

            if(empty($longitude)) {
                throw new \Exception("Longitude do estabelecimento não informada.");
            }

            $tmpBairro = [];
            $direcoes = [];

            $retorno["bairros"] = Bairro::where(["estado" => $estado, "cidade" => $cidade])->orderBy("bairro", "asc")->get();
            
            // Obtendo as localizações dos bairros
            $bairros = Bairro::where(["estado" => $estado, "cidade" => $cidade])->get();
            $contador = 0;
            $grupo = 1;
            if($bairros->count() > 0) {
                foreach($bairros as $bairro) {
                    $latitudeBairro = $bairro->latitude;
                    $longitudeBairro = $bairro->longitude;
                    if(!empty($latitudeBairro) && !empty($longitudeBairro)) {
                        $direcoes["g" . $grupo][] = ($latitudeBairro . "," . $longitudeBairro);
                        $tmpBairro["g" . $grupo][] = $bairro->id;
                        $contador++;
                    }

                    // Atingiu 100 elementos ?
                    if($contador % 99 === 0) {
                        $grupo++;
                    }
                }
            }

            $valoresBairros = [];
            $distanciaEstabelecimentoBairros = [];
            if(!empty($direcoes)) {
                $valoresKm = ValorDistancia::orderBy("km_inicial", "asc")->get();
                foreach($direcoes as $grupo => $grupoBairros) {
                    
                    // Adiciona no inicio do array a latitude/longitude do bairro do estabelecimento
                    array_unshift($grupoBairros, ($latitude . "," . $longitude));
                    $distancias = $this->mapquestApi->obterDirecoes($grupoBairros);
                    
                    if($distancias["ok"]) {
                        $chave = 0;
                        foreach($tmpBairro[$grupo] as $idBairro) {
                            if($chave > 0) { // pula o primeiro item (pois é o próprio bairro do estabelecimento)
                                $kmEstabelecimentoBairro = !isset($distancias["distancias"][$chave]) ? 0 : $distancias["distancias"][$chave];
                                $valoresBairros[$idBairro] = "";
                                $distanciaEstabelecimentoBairros[$idBairro] = $kmEstabelecimentoBairro;
                                foreach($valoresKm as $valorKm) {
                                    if($kmEstabelecimentoBairro <= $valorKm->km_final) {
                                        $valoresBairros[$idBairro] = floatToMoney($valorKm->valor);
                                        break;
                                    }
                                }
                            }
                            $chave++;
                        }
                    }
                }
            }

            // Atualização da distância do estbelecimento para com os bairros
            if(!empty($idEstabelecimento) && !empty($distanciaEstabelecimentoBairros)) {
                foreach($distanciaEstabelecimentoBairros as $idbairro => $distancia) {
                    BairroEstabelecimento::where([
                        "bairro_id" => $idbairro,
                        "estabelecimento_id" => $idEstabelecimento
                    ])
                    ->update(["distancia" => $distancia]);
                }
            }

            $retorno["valoresBairros"] = $valoresBairros;
        } catch (\Exception $e) {
            $retorno["ok"] = false;
            $retorno["msg"] = $e->getMessage();
        }

        return response()->json($retorno);
    }

    public function obterLatitudeLongitude(Request $request) {
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', 'https://geokeo.com/geocode/v1/search.php?q=' . $request->dadosEndereco . '&api=YOUR_API_KEY%0A', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
        $codeStatus = $response->getStatusCode();
        $responseBody = json_decode($response->getBody()->getContents());

        echo json_encode($responseBody);
    }
}