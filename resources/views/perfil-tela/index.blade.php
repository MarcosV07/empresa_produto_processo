@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Perfis x Telas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Perfis x Telas</li>
            </ol>
        </div>
  </div>
@stop

@section('css')
    <style type="text/css">
        .dt-head-center { text-align: center !important; }
    </style>
@endsection

@section('plugins.Datatables', true)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Associação entre Perfis e Telas</h3>
            </div>
              <div class="card-body">
                    
                    <div class="form-group">
                      <label for="">Perfil</label>
                      <form action="{{ route('perfil-tela.associacao') }}" method="POST" id="formPerfisAssociacao">
                        @csrf
                        <select class="form-control" name="perfil_id" id="perfil_id" onchange="carregarTelasPerfil(this)">
                            <option value="">- Selecione -</option>
                            @foreach($perfis as $perfil)
                            <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                            @endforeach
                        </select>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Tela</th>
                                    <th>Rota</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($telas as $tela)
                                    <tr>
                                        <td>{{ $tela->nome }}</td>
                                        <td>{{ $tela->rota }}</td>
                                        <td class="text-center">
                                            <input type="checkbox" id="tela_id_{{ $tela->id }}" class="checkbox-tela" value="{{ $tela->id }}" onclick="associarPerfilTela(this)"/>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('perfil-tela.associar') }}" method="POST" id="formPerfilTelaAssociar">
                        @csrf
                        <input type="hidden" name="pt_tela_id" id="pt_tela_id">
                        <input type="hidden" name="pt_perfil_id" id="pt_perfil_id">
                    </form>
              </div>
          </div>
    </div>
</div>
@stop

@section('js')
    <script src="js/perfil-tela/index.js"></script>
@stop