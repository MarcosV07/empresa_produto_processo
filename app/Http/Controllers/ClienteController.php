<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use App\Http\Requests\StoreClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::paginate(20);
        return view("cliente.index", ["clientes" => $cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cliente.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        if(!empty($request["valor_saldo"])) {
            $request["valor_saldo"] = moneyToFloat($request["valor_saldo"]);
        }
        Cliente::create($request->all());
        toastr()->success('Cliente cadastrado com sucesso');
        return redirect()->route("cliente.index");
    }

    /**
     * Mantém os dados do usuário principal do estabelecimento
     */
    private function manterUsuarioPrincialCliente($idCliente, $idUser, $dadosCliente) {
        // Verifica se o estabelecimento já possui um usuário principal vinculado
        if(empty($idUser)) {
            $idPerfilEstabelecimento = $this->obterValorConfiguracao("ID_PERFIL_ESTABELECIMENTO");
            $dados = [
                "name" => $dadosEstabelecimento["nome"],
                "email" => $dadosEstabelecimento["email"],
                "password" => $dadosEstabelecimento["senha"],
                "perfil_id" => $idPerfilEstabelecimento,
                "ativo" => true,
                "estabelecimento_id" => $idEstabelecimento
            ];
            $idUser = DB::table("users")->insertGetId($dados);
            Estabelecimento::where(["id" => $idEstabelecimento])->update(["user_id" => $idUser]);
        } else { // Estabelecimento já possui usuário vinculado (alteração dos dados)

            $dados = [
                "name" => $dadosEstabelecimento["nome"],
                "email" => $dadosEstabelecimento["email"]
            ];

            // Criptografa a senha caso o usuário informe
            if(!empty($dadosEstabelecimento["senha"])) {
                $dados["password"] = Hash::make($dadosEstabelecimento["senha"]);
            }

            User::where(["id" => $idUser])->update($dados);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $cliente->valor_saldo = floatToMoney($cliente->valor_saldo);
        return view("cliente.create", ["cliente" => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest $request
     * @param  \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClienteRequest $request, Cliente $cliente)
    {        

        if(!empty($request["valor_saldo"])) {
            $request["valor_saldo"] = moneyToFloat($request["valor_saldo"]);
        }
        $cliente->update($request->all());
        toastr()->success('Cliente alterado com sucesso');
        return redirect()->route("cliente.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        toastr()->success('Cliente excluído com sucesso');
        return redirect()->route("cliente.index");
    }
}
