@extends('adminlte::page')

@section('title', 'Telas')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Telas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tela.index') }}">Telas</a></li>
                <li class="breadcrumb-item active">@if(isset($tela)) Edição @else Cadastro @endif</li>
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
                      {{ isset($tela) ? "Edição" : "Cadastro" }}
                    </h3>
                </div>
            </div>
              <div class="card-body">
                @if(isset($tela))
                  <form role="form" method="POST" action="{{ route('tela.update', ['tela' => $tela]) }}">
                    @method('PUT')
                @else
                  <form role="form" method="POST" action="{{ route('tela.store') }}">
                @endif
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label for="nome">Nome</label>
                        <x-adminlte-input name="nome" placeholder="Nome da Tela" value="{{ $tela->nome ?? old('nome') }}" />
                      </div>

                      <div class="form-group">
                        <label for="modulo_id">Modulo</label>
                          <select name="modulo_id" id="modulo_id" class="form-control">
                            <option value="">- Selecione -</option>
                            @foreach($modulos as $modulo)
                              <option {{ $modulo->id == ($tela->modulo_id ?? old('modulo_id')) ? "selected" : "" }} value="{{ $modulo->id }}">
                                {{ $modulo->nome }}
                              </option>
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                        <label for="rota">Rota</label>
                        <x-adminlte-input name="rota" placeholder="Rota da Tela" value="{{ $tela->rota ?? old('rota') }}" />
                      </div>

                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="menu" name="menu" {{ old('menu') || ($tela->menu ?? false) ? "checked" : ""}}>
                        <label class="form-check-label" for="menu">Tela presente no menu ?</label>
                      </div>

                      <div class="form-group">
                        <label for="icone">Ícone do Menu</label>
                        <input type="text" class="form-control" id="icone" name="icone" placeholder="Ícone do Menu" value="{{ $tela->icone ?? old('icone') }}">
                      </div>

                      <div class="form-group">
                        <label for="ordem">Ordem da Tela no Menu</label>
                        <input type="number" class="form-control" id="ordem" name="ordem" placeholder="Ordem da tela no menu" value="{{ $tela->ordem ?? old('ordem') }}">
                      </div>
                      
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="auditoria" name="auditoria" {{ old('auditoria') || ($tela->auditoria ?? false) ? "checked" : ""}}>
                        <label class="form-check-label" for="auditoria">Tela/Funcionalidade deverá ser auditada  ?</label>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="button" onclick="window.location='{{ url()->previous() }}'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</button>
                      <button type="submit" class="btn btn-primary">
                        @if(isset($tela))
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