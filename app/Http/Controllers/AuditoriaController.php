<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditoria;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auditorias = Auditoria::join("users", "users.id", "=", "auditorias.usuario_id")
                        ->join("telas", "telas.id", "=", "auditorias.tela_id");

        // Filtros
        $parametros = $request->all();
        
        $nomeUsuario = trim($parametros["name"] ?? "");
        if(!empty($nomeUsuario)) {
            $auditorias = $auditorias->where("users.name", "like", "%" . $parametros["name"] . "%");
        }

        $tela = trim($parametros["tela"] ?? "");
        if(!empty($tela)) {
            $auditorias = $auditorias->where("telas.nome", "like", "%" . $parametros["tela"] . "%");
        }

        $periodo = trim($parametros["periodo"] ?? "");
        if(!empty($periodo)) {
            list($dataInicio, $dataFim) = explode(" - ", $periodo);
            $dataInicio = \DateTime::createFromFormat('d/m/Y H:i', $dataInicio);
            $dataFim = \DateTime::createFromFormat('d/m/Y H:i', $dataFim);
            $auditorias = $auditorias->whereBetween("auditorias.created_at", [$dataInicio, $dataFim]);
        }
                    
        $auditorias = $auditorias->orderBy("auditorias.created_at", "desc")->paginate(20);

        return view("auditoria.index", ["auditorias" => $auditorias, "parametros" => $parametros]);
    }
}
