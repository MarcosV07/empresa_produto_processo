<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstabelecimentoRequest;
use Illuminate\Http\Request;
use App\Models\Estabelecimento;
use App\Models\SituacaoEstabelecimento;
use App\Models\Categoria;
use App\Models\TipoPessoa;
use App\Models\Dia;
use Illuminate\Support\Facades\DB;
use App\Models\DiaEstabelecimento;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoFormaPagamento;
use App\Models\FormaPagamentoEstabelecimento;
use App\Models\BairroEstabelecimento;
use App\Models\Bairro;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EstabelecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $situacoes = SituacaoEstabelecimento::all();
        $categorias = Categoria::orderBy('nome')->get();
        $parametros = $request->all();

        $estabelecimentos = Estabelecimento::with(["tipoPessoa", "situacaoEstabelecimento", "categoria"]);

        $nome = trim($parametros["nome"] ?? "");
        if(!empty($nome)) {
            $estabelecimentos = $estabelecimentos->where("nome", "like", "%$nome%");
        }

        $idSituacaoEstabelecimento = trim($parametros["situacao_estabelecimento_id"] ?? "");
        if(!empty($idSituacaoEstabelecimento)) {
            $estabelecimentos = $estabelecimentos->where("situacao_estabelecimento_id", $idSituacaoEstabelecimento);
        }

        $idCategoria = trim($parametros["categoria_id"] ?? "");
        if(!empty($idCategoria)) {
            $estabelecimentos = $estabelecimentos->where("categoria_id", $idCategoria);

        }

        $estabelecimentos = $estabelecimentos->orderBy("created_at", "desc")->paginate(20);
        
        return view("estabelecimento.index", [
            "estabelecimentos" => $estabelecimentos,
            "situacoes" => $situacoes,
            "categorias" => $categorias,
            "parametros" => $parametros
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoPessoas = TipoPessoa::all();
        $categoria = Categoria::all();
        $situacoesEstabelecimento = SituacaoEstabelecimento::all();
        $dias = Dia::all();
        $tipoFormaPagamentos = TipoFormaPagamento::with("formasPagamento")->get();
        $bairros = [];
        $formaPagamentoEstabelecimentos = [];
        $bairrosEstabelecimentos = [];
        $usuariosEstabelecimento = [];
        $eSuperAdmin = $this->eSuperAdmin();

        return view("estabelecimento.create", [
            "tipoPessoas" => $tipoPessoas,
            "categoria" => $categoria,
            "situacoesEstabelecimento" => $situacoesEstabelecimento,
            "estabelecimento" => null,
            "dias" => $dias,
            "diaEstabelecimentos" => null,
            "tipoFormaPagamentos" => $tipoFormaPagamentos,
            "bairros" => $bairros,
            "formaPagamentoEstabelecimentos" => $formaPagamentoEstabelecimentos,
            "bairrosEstabelecimentos" => $bairrosEstabelecimentos,
            "usuariosEstabelecimento" => $usuariosEstabelecimento,
            "eSuperAdmin" => $eSuperAdmin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEstabelecimentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstabelecimentoRequest $request)
    {
        try {
            DB::beginTransaction();

            $parametros = $request->all();

            // Upload da imagem de logotipo
            if($request->hasFile("arquivo_logotipo") && $request->file("arquivo_logotipo")->isValid()) {
                $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_ESTABELECIMENTO");
                $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo_logotipo'));
                $parametros["logotipo"] = $foto;
            }

            // Upload da imagem de fundo
            if($request->hasFile("arquivo_fundo_cabecalho") && $request->file("arquivo_fundo_cabecalho")->isValid()) {
                $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_ESTABELECIMENTO");
                $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo_fundo_cabecalho'));
                $parametros["fundo_cabecalho"] = $foto;
            }

            // Conversão do valor minímo antes de salvar no banco
            if(!empty($parametros["valor_minimo_pedido"])) {
                $parametros["valor_minimo_pedido"] = moneyToFloat($parametros["valor_minimo_pedido"]);
            } else {
                $parametros["valor_minimo_pedido"] = 0.00;
            }

            // Indicação se o estabelecimento permite retirada ou não
            $parametros["permite_retirada"] = isset($parametros["permite_retirada"]) ? true : false;

            $estabelecimento = Estabelecimento::create($parametros);
            $this->salvarHorarioFuncionamento($estabelecimento->id, $request->dia_estabelecimentos);
            $this->salvarFormaPagamento($estabelecimento->id, $request->estabelecimento_forma_pagamento);
            $this->salvarBairroEstabelecimento($estabelecimento->id, $request->bairro_estabelecimento);

            // Mantém o usuário principal do estabelecimento
            $this->manterUsuarioPrincialEstabelecimento($estabelecimento->id, null, $parametros);

            // Mantém os usuários adicionais ao estabelecimento
            $this->salvarUsuariosEstabelecimento($estabelecimento->id, $request->usuarios_estabelecimento);

            toastr()->success('Estabelecimento cadastrado com sucesso');

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            toastr()->error($e->getMessage());
            DB::rollBack();
        }

        return redirect()->route("estabelecimento.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Estabelecimento $estabelecimento)
    {
        $tipoPessoas = TipoPessoa::all();
        $categoria = Categoria::all();
        $situacoesEstabelecimento = SituacaoEstabelecimento::all();
        $dias = Dia::all();
        $diaEstabelecimentos = DiaEstabelecimento::where(["estabelecimento_id" => $estabelecimento->id])->get();
        $formaPagamentoEstabelecimentos = FormaPagamentoEstabelecimento::where(["estabelecimento_id" => $estabelecimento->id])->get()->pluck("forma_pagamento_id")->toArray();
        $tipoFormaPagamentos = TipoFormaPagamento::with("formasPagamento")->get();
        $bairros = Bairro::where(["estado" => $estabelecimento->estado, "cidade" => $estabelecimento->cidade])->orderBy("bairro", "asc")->get();
        $bairrosEstabelecimentos = BairroEstabelecimento::where(["estabelecimento_id" => $estabelecimento->id])->get()->pluck("valor_entrega", "bairro_id")->toArray();
        $estabelecimento->valor_minimo_pedido = floatToMoney($estabelecimento->valor_minimo_pedido);
        $usuariosEstabelecimento = User::where(["estabelecimento_id" => $estabelecimento->id])->where("id", "<>", $estabelecimento->user_id)->orderBy("name", "asc")->get();
        $eSuperAdmin = $this->eSuperAdmin();

        return view("estabelecimento.create", [
            "estabelecimento" => $estabelecimento,
            "tipoPessoas" => $tipoPessoas,
            "categoria" => $categoria,
            "situacoesEstabelecimento" => $situacoesEstabelecimento,
            "dias" => $dias,
            "diaEstabelecimentos" => $diaEstabelecimentos,
            "tipoFormaPagamentos" => $tipoFormaPagamentos,
            "formaPagamentoEstabelecimentos" => $formaPagamentoEstabelecimentos,
            "bairros" => $bairros,
            "bairrosEstabelecimentos" => $bairrosEstabelecimentos,
            "usuariosEstabelecimento" => $usuariosEstabelecimento,
            "eSuperAdmin" => $eSuperAdmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreEstabelecimentoRequest  $request
     * @param  \App\Models\Estabelecimento $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEstabelecimentoRequest $request, Estabelecimento $estabelecimento)
    {
        try {

            DB::beginTransaction();

            $parametros = $request->all();

            // Upload da imagem de logotipo
            if($request->hasFile("arquivo_logotipo") && $request->file("arquivo_logotipo")->isValid()) {
                $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_ESTABELECIMENTO");
                $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo_logotipo'));
                $parametros["logotipo"] = $foto;
            }

            // Upload da imagem de fundo
            if($request->hasFile("arquivo_fundo_cabecalho") && $request->file("arquivo_fundo_cabecalho")->isValid()) {
                $caminho = $this->obterValorConfiguracao("CAMINHO_IMAGENS_ESTABELECIMENTO");
                $foto = Storage::disk('public')->putFile($caminho, $request->file('arquivo_fundo_cabecalho'));
                $parametros["fundo_cabecalho"] = $foto;
            }

            // Conversão do valor minímo antes de salvar no banco
            if(!empty($parametros["valor_minimo_pedido"])) {
                $parametros["valor_minimo_pedido"] = moneyToFloat($parametros["valor_minimo_pedido"]);
            } else {
                $parametros["valor_minimo_pedido"] = 0.00;
            }

            // Indicação se o estabelecimento permite retirada ou não
            $parametros["permite_retirada"] = isset($parametros["permite_retirada"]) ? true : false;

            $estabelecimento->update($parametros);
            $this->salvarHorarioFuncionamento($estabelecimento->id, $request->dia_estabelecimentos);
            $this->salvarFormaPagamento($estabelecimento->id, $request->estabelecimento_forma_pagamento);
            $this->salvarBairroEstabelecimento($estabelecimento->id, $request->bairro_estabelecimento);

            // Mantém o usuário principal do estabelecimento
            $this->manterUsuarioPrincialEstabelecimento($estabelecimento->id, $estabelecimento->user_id, $parametros);

            // Mantém os usuários adicionais ao estabelecimento
            $this->salvarUsuariosEstabelecimento($estabelecimento->id, $request->usuarios_estabelecimento);

            toastr()->success('Estabelecimento alterado com sucesso');

            DB::commit();

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            DB::rollBack();
        }

        // Caso o usuário autenticado possua perfil de estbalecimento redireciona para a mesma tela com os dados alterados
        if($this->eEstabelecimento()) {
            return redirect()->route("estabelecimento.edit", ["estabelecimento" => $estabelecimento->id]);
        } else {
            // Usuário super admin -> Redireciona para tela de listagem de estabelecimentos
            return redirect()->route("estabelecimento.index");
        }
    }

    private function salvarHorarioFuncionamento($idEstabelecimento, $dias) {

        DiaEstabelecimento::where(["estabelecimento_id" => $idEstabelecimento])->delete();

        if(!empty($dias) && count($dias) > 0) {
            foreach($dias as $dia) {
                list($horarioInicio, $horarioFim) = explode("-", current($dia));
                $dados = [
                    "estabelecimento_id" => $idEstabelecimento,
                    "dia_id" => key($dia),
                    "horario_inicio" => $horarioInicio,
                    "horario_fim" => $horarioFim
                ];

                DiaEstabelecimento::create($dados);
            }
        }
    }

    private function salvarFormaPagamento($idEstabelecimento, $formasPagamentos) {

        FormaPagamentoEstabelecimento::where(["estabelecimento_id" => $idEstabelecimento])->delete();

        if(!empty($formasPagamentos) && count($formasPagamentos) > 0) {
            foreach($formasPagamentos as $idFormaPagamento) {
                $dados = [
                    "estabelecimento_id" => $idEstabelecimento,
                    "forma_pagamento_id" => $idFormaPagamento
                ];

                FormaPagamentoEstabelecimento::create($dados);
            }
        }
    }

    private function salvarBairroEstabelecimento($idEstabelecimento, $bairroEstabelecimentos) {
        BairroEstabelecimento::where(["estabelecimento_id" => $idEstabelecimento])->delete();

        if(!empty($bairroEstabelecimentos) && count($bairroEstabelecimentos) > 0) {
            foreach($bairroEstabelecimentos as $idBairro => $bairroEstabelecimento) {

                $valorEntrega = 0.00;
                if(!empty($bairroEstabelecimento["valor_entrega"])) {
                    $valorEntrega = moneyToFloat($bairroEstabelecimento["valor_entrega"]);
                }

                $dados = [
                    "estabelecimento_id" => $idEstabelecimento,
                    "bairro_id" => $idBairro,
                    "valor_entrega" => $valorEntrega,
                    "ativo" => isset($bairroEstabelecimento["id"]) ? true : false
                ];

                BairroEstabelecimento::create($dados);
            }
        }
    }

    /**
     * Mantém os dados do usuário principal do estabelecimento
     */
    private function manterUsuarioPrincialEstabelecimento($idEstabelecimento, $idUser, $dadosEstabelecimento) {
        // Verifica se o estabelecimento já possui um usuário principal vinculado
        if(empty($idUser)) {
            $idPerfilEstabelecimento = $this->obterValorConfiguracao("ID_PERFIL_ESTABELECIMENTO");
            $dados = [
                "name" => $dadosEstabelecimento["nome"],
                "email" => $dadosEstabelecimento["email"],
                "password" => Hash::make($dadosEstabelecimento["senha"]),
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
     * Função responsável por salvar novos usuários atrelados ao estabelecimento
     */
    private function salvarUsuariosEstabelecimento($idEstabelecimento, $usuariosEstabelecimento) {

        if(!empty($usuariosEstabelecimento) && count($usuariosEstabelecimento) > 0) {
            $idPerfilEstabelecimento = $this->obterValorConfiguracao("ID_PERFIL_ESTABELECIMENTO");
            foreach($usuariosEstabelecimento as $usuarioEstabelecimento) {
                $dados = [
                    "name" => $usuarioEstabelecimento["name"],
                    "email" => $usuarioEstabelecimento["email"],
                    "password" => Hash::make($usuarioEstabelecimento["password"]),
                    "perfil_id" => $idPerfilEstabelecimento,
                    "ativo" => true,
                    "estabelecimento_id" => $idEstabelecimento
                ];
                
                /*
                @todo
                $validator = Validator::make($dados, [
                    "name" => "required",
                    "email" => "required|email:rfc,dns|unique:users",
                    "password" => "required",
                    "perfil_id" => "required|integer",
                    "ativo" => "boolean",
                    "estabelecimento_id" => "required|integer"
                ]);

                if ($validator->fails()) {
                    return redirect()->route("estabelecimento.edit", [
                        "estabelecimento" => $idEstabelecimento
                    ])->with("errors-acesso", json_encode($validator->errors()));
                }
                */

                User::create($dados);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estabelecimento $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento)
    {
        $estabelecimento->delete();
        toastr()->success('Estabelecimento excluído com sucesso');
        return redirect()->route("estabelecimento.index");
    }

    public function meuEstabelecimento(Request $request) {
        $idEstabelecimento = auth()->user()->estabelecimento_id;
        return redirect()->route("estabelecimento.edit", ["estabelecimento" => $idEstabelecimento]);
    }
}
