<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TelaController;
use \App\Http\Controllers\PerfilController;
use \App\Http\Controllers\ModuloController;
use \App\Http\Controllers\PerfilTelaController;
use \App\Http\Controllers\ConfiguracaoController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\AuditoriaController;
use \App\Http\Controllers\TipoFormaPagamentoController;
use \App\Http\Controllers\FormaPagamentoController;
use \App\Http\Controllers\TipoPessoaController;
use \App\Http\Controllers\CategoriaController;
use \App\Http\Controllers\SituacaoEstabelecimentoController;
use \App\Http\Controllers\DiaController;
use \App\Http\Controllers\EstabelecimentoController;
use \App\Http\Controllers\ValorDistanciaController;
use \App\Http\Controllers\BairroController;
use \App\Http\Controllers\ProdutoController;
use \App\Http\Controllers\CategoriaProdutoController;
use \App\Http\Controllers\PedidoController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\StatusPedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas das telas de autenticação
Auth::routes();


//Route::get("home", [HomeController::class, "index"]);

// Rotas autenticadas (passou pelo controle de acesso)
Route::middleware("auth", "acl", "auditoria")->group(function() {

    Route::get("/", [App\Http\Controllers\HomeController::class, "index"])->name("home");

    Route::resource("categoria", CategoriaController::class);

    Route::resource("categoria-produto", CategoriaProdutoController::class);

    Route::resource("produto", ProdutoController::class);

    Route::resource("status-pedido", StatusPedidoController::class);

    Route::resource("cliente", ClienteController::class);

    Route::resource("pedido", PedidoController::class);

    Route::resource("tela", TelaController::class);

    Route::resource("perfil", PerfilController::class);

    Route::resource("modulo", ModuloController::class);

    Route::resource("configuracao", ConfiguracaoController::class);

    Route::resource("usuario", UsuarioController::class);

    Route::resource("tipo-forma-pagamento", TipoFormaPagamentoController::class);

    Route::resource("forma-pagamento", FormaPagamentoController::class);

    Route::resource("tipo-pessoa", TipoPessoaController::class);

    Route::resource("situacao-estabelecimento", SituacaoEstabelecimentoController::class);

    // Por algum motivo o parâmetro para a rota de dias ficou com o nome "dium" e estava impactando
    // nas rotas de PUT e Delete (por este motivo criei de forma manual)
    //Route::resource("dia", DiaController::class);
    Route::get("dia", [DiaController::class, "index"])->name("dia.index");
    Route::get("dia/create", [DiaController::class, "create"])->name("dia.create");
    Route::post("dia", [DiaController::class, "store"])->name("dia.store");
    Route::get("dia/{dia}/edit", [DiaController::class, "edit"])->name("dia.edit");
    Route::put("dia/{dia}", [DiaController::class, "update"])->name("dia.update");
    Route::delete("dia/{dia}", [DiaController::class, "destroy"])->name("dia.destroy");
    Route::get("auditoria", [AuditoriaController::class, "index"])->name("auditoria.index");

    Route::resource("estabelecimento", EstabelecimentoController::class);

    Route::resource("bairro", BairroController::class);

    //Route::resource("valor-distancia", ValorDistanciaController::class);
    Route::get("valor-distancia", [ValorDistanciaController::class, "index"])->name("valor-distancia.index");
    Route::get("valor-distancia/create", [ValorDistanciaController::class, "create"])->name("valor-distancia.create");
    Route::post("valor-distancia", [ValorDistanciaController::class, "store"])->name("valor-distancia.store");
    Route::get("valor-distancia/{valorDistancia}/edit", [ValorDistanciaController::class, "edit"])->name("valor-distancia.edit");
    Route::put("valor-distancia/{valorDistancia}", [ValorDistanciaController::class, "update"])->name("valor-distancia.update");
    Route::delete("valor-distancia/{valorDistancia}", [ValorDistanciaController::class, "destroy"])->name("valor-distancia.destroy");

    Route::get("usuario.ativar/{usuario}", [UsuarioController::class, "ativar"])->name("usuario.ativar");

    Route::post("bairro/obterBairrosPorCidade", [BairroController::class, "obterBairrosPorCidade"])->name("bairro.obterBairrosPorCidade");
    Route::post("bairro/obterLatitudeLongitude", [BairroController::class, "obterLatitudeLongitude"])->name("bairro.obterLatitudeLongitude");

    Route::get("usuario.desativar/{usuario}", [UsuarioController::class, "desativar"])->name("usuario.desativar");

    Route::get("perfil-tela", [PerfilTelaController::class, "index"])->name("perfil-tela.index");

    Route::post("perfil-tela.associar", [PerfilTelaController::class, "associar"])->name("perfil-tela.associar");

    Route::post("perfil-tela", [PerfilTelaController::class, "associacao"])->name("perfil-tela.associacao");

    Route::post("usuario.ativarDesativarAcessoUsuarioEstabelecimento", [UsuarioController::class, "ativarDesativarAcessoUsuarioEstabelecimento"])->name("usuario.ativarDesativarAcessoUsuarioEstabelecimento");

    Route::get("meu-estabelecimento", [EstabelecimentoController::class, "meuEstabelecimento"])->name("meu-estabelecimento");



});
