<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Models\Estabelecimento;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perfis = Perfil::all();
        $usuarios = Usuario::with("perfil");
        
        // Filtros
        $parametros = $request->all();
        
        $nomeUsuario = trim($parametros["name"] ?? "");
        if(!empty($nomeUsuario)) {
            $usuarios = $usuarios->where("name", "like", "%" . $parametros["name"] . "%");
        }

        $idPerfil = trim($parametros["perfil_id"] ?? "");
        if(!empty($idPerfil)) {
            $usuarios = $usuarios->where("perfil_id", $parametros["perfil_id"]);
        }
                    
        $usuarios = $usuarios->orderBy("created_at", "desc")->paginate(20);

        return view("usuario.index", ["usuarios" => $usuarios, "perfis" => $perfis, "parametros" => $parametros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfis = Perfil::all();
        return view("usuario.create", ["perfis" => $perfis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsuarioRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $parametros = $request->all();
        $parametros["ativo"] = ((isset($parametros["ativo"]) && $parametros["ativo"] === "on") ? true : false);
        $parametros["password"] = bcrypt($parametros["password"]);
        Usuario::create($parametros);
        toastr()->success('Usuário cadastrado com sucesso');
        return redirect()->route("usuario.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        $perfis = Perfil::all();
        return view("usuario.create", ["perfis" => $perfis, "usuario" => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsuarioRequest  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsuarioRequest $request, Usuario $usuario)
    {
        $parametros = $request->all();
        $parametros["ativo"] = ((isset($parametros["ativo"]) && $parametros["ativo"] === "on") ? true : false);
        if(!empty($parametros["password"])) {
            $parametros["password"] = bcrypt($parametros["password"]);
        } else {
            unset($parametros["password"]);
        }

        $usuario->update($parametros);
        toastr()->success('Usuário alterado com sucesso');
        return redirect()->route("usuario.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {

        Estabelecimento::where("user_id", $usuario->id)->update([
            "user_id" => null
        ]);

        $usuario->delete();
        toastr()->success('Usuário excluído com sucesso');
        return redirect()->route("usuario.index");
    }

    public function ativar(Usuario $usuario)
    {
        $usuario->update(["ativo" => true]);
        toastr()->success('Usuário ativado com sucesso');
        return redirect()->route("usuario.index");
    }

    public function desativar(Usuario $usuario)
    {
        $usuario->update(["ativo" => false]);
        toastr()->success('Usuário desativado com sucesso');
        return redirect()->route("usuario.index");
    }

    public function ativarDesativarAcessoUsuarioEstabelecimento(Request $request) {
        $retorno = [
            "ok" => true,
            "msg" => "Usuário #acao# com sucesso!"
        ];

        try {

            $ativo = $request->ativo == "true" ? true : false;
            $idUser = $request->idUser;

            Usuario::where("id", $idUser)->update(["ativo" => $ativo]);

            $acao = $ativo ? "ativado" : "desativado";
            $retorno["msg"] = str_replace("#acao#", $acao, $retorno["msg"]);

        } catch (\Exception $e) {
            $retorno["ok"] = false;
            $retorno["msg"] = $e->getMessage();
        }

        return response()->json($retorno);
    }
}
