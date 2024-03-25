@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Pedidos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Pedidos</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Listagem</h3> 
                <button class="btn btn-primary btn-xs float-right" onclick="window.location = '{{ route('pedido.create') }}'">
                    <i class="fa fa-plus"></i> Novo
                </button>
            </div>
              <div class="card-body">

              
              <form action="{{ route('pedido.index') }}" method="GET">
                        
                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estabelecimento_id">Estabelecimento: </label>
                                      <select name="estabelecimento_id" id="estabelecimento_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($estabelecimentos as $estabelecimento)
                                          <option {{ ($estabelecimento->id == ($parametros['estabelecimento_id'] ?? null)) ? "selected" : "" }} value="{{ $estabelecimento->id }}">
                                            {{ $estabelecimento->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="produto_id">Produto: </label>
                                      <select name="produto_id" id="produto_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($produtos as $produto)
                                          <option {{ ($produto->id == ($parametros['produto_id'] ?? null)) ? "selected" : "" }} value="{{ $produto->id }}">
                                            {{ $produto->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cliente_id">Cliente:</label>
                                      <select name="cliente_id" id="cliente_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($clientes as $cliente)
                                          <option {{ ($cliente->id == ($parametros['cliente_id'] ?? null)) ? "selected" : "" }} value="{{ $cliente->id }}">
                                            {{ $cliente->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status_pedido_id">Status do Pedido:</label>
                                      <select name="status_pedido_id" id="status_pedido_id" class="form-control select">
                                        <option value="">- Selecione -</option>
                                        @foreach($statusPedidos as $statusPedido)
                                          <option {{ ($statusPedido->id == ($parametros['status_pedido_id'] ?? null)) ? "selected" : "" }} value="{{ $statusPedido->id }}">
                                            {{ $statusPedido->nome }}
                                          </option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning" type="button" onclick="limparFiltro()"><i class="fa fa-eraser"></i> Limpar</button>
                    </form>
                    <br><br>

                    @if(Auth::user()->perfil_id != 3)
                      <div id="app">
                        <dashboard-pedido :pedidos="{{ json_encode($pedidos) }}"></dashboard-pedido>
                      </div>
                    @endif

                    @if(Auth::user()->perfil_id == 3)
                    <div class="info-box px-0">
                      <span class="info-box-icon bg-primary"><i class="fa fa-money-bill"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Saldo Atual</span>
                        <span class="info-box-number">R$ {{ floatToMoney($saldoCliente) }}</span>
                      </div>
                    </div>

<!--                     <div class="alert alert-light" role="alert">
                       Saldo Atual: R$ {{ floatToMoney($saldoCliente) }}
                    </div> -->
                    
                    <br>
                    
                        @component('pedido._components.pedido-perfil-clientes', ["pedidos" => $pedidos])
                        @endcomponent
                    @else
                        @component('pedido._components.pedido-perfil-adm-estabelecimento', ["pedidos" => $pedidos])
                        @endcomponent                       
                    @endif
              </div>
          </div>
    </div>
</div>

<script src="{{ mix('js/app.js')}}"></script>
@stop

@section('js')
    <script type="text/javascript">
        function limparFiltro() {
            $("form").find("input,select").each(function(i, el) {
                $(el).val("");
            });
        }
    </script>
@stop