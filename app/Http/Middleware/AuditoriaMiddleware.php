<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use \App\Models\Tela;
use \App\Models\Auditoria;

class AuditoriaMiddleware
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
        $tela = Tela::where("rota", $rota)->first();
        
        if($tela->auditoria) {

            // Id do usuário autenticado
            $idUsuario = auth()->user()->id;
            $uri = $request->path();
            $dispositivo = $request->server("HTTP_USER_AGENT");
            Auditoria::create([
                "tela_id" => $tela->id,
                "usuario_id" => $idUsuario,
                "dados" => json_encode($request->all()),
                "url" => $uri,
                "dispositivo" => $dispositivo
            ]);
        }

        return $next($request);
    }
}
