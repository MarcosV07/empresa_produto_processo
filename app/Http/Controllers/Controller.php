<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \App\Models\Configuracao;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function obterValorConfiguracao($chave) {
        
        $retorno = "";
        
        if(is_array($chave)) {
            $configuracoes = DB::table("configuracoes")->whereIn("chave", $chave)->pluck("chave", "valor")->all();
            if(!empty($configuracoes)) {
                $retorno = array_flip($configuracoes);
            }
        } else {
            $configuracao = Configuracao::where("chave", $chave)->select("valor")->first();
            if(!empty($configuracao)) {
                $retorno = $configuracao->valor;
            }
        }
        
        if(empty($retorno)) {
            $msgErroConf = is_array($chave) ? "Configurações não definidas: " . implode(", ", $chave) : "Configuração não definida: " . $chave;
            toastr()->error($msgErroConf);
        }

        return $retorno;
    }

    /**
     * Verifica se o usuário autenticado é um estabelecimento
     */
    public function eEstabelecimento() {
        $idPerfilEstabelecimento = $this->obterValorConfiguracao("ID_PERFIL_ESTABELECIMENTO");
        return auth()->user()->perfil_id == $idPerfilEstabelecimento;
    }

    /**
     * Verifica se o usuário autenticado é um super admin
     */
    public function eSuperAdmin() {
        $idPerfilSuperAdmin = $this->obterValorConfiguracao("ID_PERFIL_ADMIN");
        return auth()->user()->perfil_id == $idPerfilSuperAdmin;
    }
}
