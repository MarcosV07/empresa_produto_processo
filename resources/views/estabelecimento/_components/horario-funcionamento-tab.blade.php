<button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target="#modalAdicionarHorario">
    <i class="fas fa-clock"></i> Adicionar horário
</button>

<div class="table-responsive mt-3">
    <table class="table">
        <thead>
            <tr>
                @foreach($dias as $dia)
                    <th>{{ explode("-", $dia->nome)[0] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody id="corpoTabelaHorarioFuncionamento">
            <tr>
                <td>
                    <ul id="lDia1" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia2" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia3" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia4" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia5" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia6" class="listaDia"></ul>
                </td>
                <td>
                    <ul id="lDia7" class="listaDia"></ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<x-adminlte-modal id="modalAdicionarHorario"
    title="Adicionar horário de funcionamento"
    size="xl"
    icon="fas fa-clock">
    
    <div class="row">

        @foreach($dias as $dia)
        <div class="float-left">
            <div class="mr-5">
                <input type="checkbox" name="dia-establecimento" id="{{ $dia->id }}" value="{{ $dia->id }}" class="dia">
                <label for="{{ $dia->id }}">{{ $dia->nome }}</label> 
            </div>
        </div>
        @endforeach
    </div>


    <div class="row">
        <div class="col-md-3">
            <label for="dia_estabelecimentos.horario_inicio">Horário Início</label>
            <div class="input-group">
                <input type="text" id="dia_estabelecimentos_horario_inicio" name="dia_estabelecimentos.horario_inicio" class="form-control horario">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label for="dia_estabelecimentos.horario_fim">Horário Fim</label>
            <div class="input-group">
                <input type="text" id="dia_estabelecimentos_horario_fim" name="dia_estabelecimentos.horario_fim" class="form-control horario">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
              </div>
        </div>
    </div>

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="success" label="Salvar" onclick="adicionarHorarioFuncionamento()" />
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>