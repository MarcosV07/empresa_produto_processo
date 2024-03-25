<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class ControleAcesso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Rota acessada
        $rota = Route::currentRouteName();
        // Id do perfil de usuário
        $idPerfil = auth()->user()->perfil_id;
        // Consulta no banco para verificar se o usuário possui ou não o acesso a tela
        $acesso = Db::table("perfis_telas")
        ->join("telas", "perfis_telas.tela_id", "=", "telas.id")
        ->where("perfis_telas.perfil_id", $idPerfil)
        ->where("telas.rota", $rota)
        ->count();
        
        //dd($acesso);

        if($acesso > 0) {
            return $next($request);
        } else {
            toastr()->info('Infelizmente você não possui acesso a esta tela.');
            return back()->withInput();
        }
    }
}
