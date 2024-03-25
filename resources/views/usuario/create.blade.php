@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Usuários</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('usuario.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">@if(isset($usuario)) Edição @else Cadastro @endif</li>
            </ol>
        </div>
  </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="row">
                    <h3 class="card-title">
                      {{ isset($usuario) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($usuario))
                  <form role="form" method="POST" action="{{ route('usuario.update', ['usuario' => $usuario]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('usuario.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="name">Nome</label>
                        <x-adminlte-input name="name" placeholder="Nome do Usuário" value="{{ $usuario->name ?? old('name') }}" />
                      </div>

                      <div class="form-group">
                        <label for="perfil_id">Perfil</label>
                          <select name="perfil_id" id="perfil_id" class="form-control">
                            <option value="">- Selecione -</option>
                            @foreach($perfis as $perfil)
                              <option {{ $perfil->id == ($usuario->perfil_id ?? old('perfil_id')) ? "selected" : "" }} value="{{ $perfil->id }}">
                                {{ $perfil->nome }}
                              </option>
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                        <label for="email">E-mail</label>
                        <x-adminlte-input type="email" name="email" placeholder="E-mail do Usuário" value="{{ $usuario->email ?? old('email') }}" />
                      </div>

                      <div class="form-group">
                        <label for="password">Senha</label>
                        <x-adminlte-input type="password" name="password" placeholder="Senha do Usuário" value="" />
                      </div>

                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" {{ old('ativo') || ($usuario->ativo ?? false) ? "checked" : ""}}>
                        <label class="form-check-label" for="menu">Usuário ativo ?</label>
                      </div>
                      
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($usuario))
                        <i class="fa fa-edit"></i> Alterar
                        @else
                        <i class="fa fa-save"></i> Salvar
                        @endif
                      </button>
                    </div>
                  </form>
              </div>
          </div>
    </div>
</div>
@stop