<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilTela;
use App\Models\Tela;
use App\Models\Perfil;

class PerfilTelaController extends Controller
{
    public function index()
    {
        $telas = Tela::all();
        $perfis = Perfil::orderBy("nome", "asc")->get();
        return view("perfil-tela.index", ["telas" => $telas, "perfis" => $perfis]);
    }

    public function associacao(Request $request) {
        $telas = PerfilTela::where(["perfil_id" => $request->perfil_id])->pluck('tela_id');
        return response()->json($telas);
    }

    public function associar(Request $request) {

        $retorno = ["ok" => true, "msg" => "Tela associada com sucesso!"];

        try {

            $qtdPerfilTela = PerfilTela::where([
                "tela_id" => $request->pt_tela_id,
                "perfil_id" => $request->pt_perfil_id
            ])->count();
    
            if($qtdPerfilTela == 0) {
                PerfilTela::create([
                    "perfil_id" => $request->pt_perfil_id,
                    "tela_id" => $request->pt_tela_id,
                ]);
            } else {
                $retorno["msg"] = "Tela desassociada com sucesso!";
                PerfilTela::where([
                    "perfil_id" => $request->pt_perfil_id,
                    "tela_id" => $request->pt_tela_id,
                ])->delete();
            }

        } catch (Exception $e) {
            $retorno["ok"] = false;
            $retorno["msg"] = $e->getMessage();
        }
        
        return response()->json($retorno);
    }
}
