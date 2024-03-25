<button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target="#modalAdicionarUsuarioEstabelecimento">
    <i class="fas fa-user"></i> Adicionar usuário
</button>

<div class="table-responsive mt-3">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody id="corpoTabelaUsuariosEstabelecimento">

            @php
                $chave = 0;
            @endphp

            

            @isset($usuariosEstabelecimento)
                @foreach($usuariosEstabelecimento as $usuarioEstabelecimento)

                    <tr>
                        <td class="linha-usuario linha-usuario-{{ $chave }}">{{ $usuarioEstabelecimento->name }}</td>
                        <td>{{ $usuarioEstabelecimento->email }}</td>
                        <td>
                            <label for="userAtivo{{ $usuarioEstabelecimento->id }}">
                            <input onclick="ativarDesativarAcessoUsuarioEstabelecimento(this, {{ $usuarioEstabelecimento->id }})" type="checkbox" name="userAtivo{{ $usuarioEstabelecimento->id }}" id="userAtivo{{ $usuarioEstabelecimento->id }}" {{ isset($usuarioEstabelecimento->ativo) && ($usuarioEstabelecimento->ativo == true) ? "checked='checked'" : "" }}>
                                Permitir o acesso ?
                            </label>
                        </td>
                    </tr>

                    @php
                        $chave++;
                    @endphp

                @endforeach
            @endisset

            @if(!empty(old("usuarios_estabelecimento")))
                @foreach(old("usuarios_estabelecimento") as $usuarioEstabelecimento)

                    @php
                        $camposOcultos = "<input class='usuario-estabelecimento' type='hidden' name='usuarios_estabelecimento[" . $chave . "][name]' value='" . $usuarioEstabelecimento["name"] . "' />";
                        $camposOcultos .= "<input type='hidden' name='usuarios_estabelecimento[" . $chave . "][email]' value='" . $usuarioEstabelecimento["email"] . "' />";
                        $camposOcultos .= "<input type='hidden' name='usuarios_estabelecimento[" . $chave . "][password]' value='" . $usuarioEstabelecimento["password"] . "' />";

                        $acaoExcluirUsuarioEstabelecimento = "<a class='text-danger' href='javascript:void(0);' onclick='$(\".linha-usuario-" . $chave . "\").parents(\"tr\").remove();'><i class='fas fa-trash'></i> Remover</a>";
                    @endphp

                    <tr>
                        <td class="linha-usuario linha-usuario-{{ $chave }}">{!! $camposOcultos !!} {{ $usuarioEstabelecimento["name"] }}</td>
                        <td>{{ $usuarioEstabelecimento["email"] }}</td>
                        <td>{!! $acaoExcluirUsuarioEstabelecimento !!}</td>
                    </tr>

                    @php
                        $chave++;
                    @endphp

                @endforeach
            @endif
        </tbody>
    </table>
</div>

<x-adminlte-modal id="modalAdicionarUsuarioEstabelecimento"
    title="Adicionar um novo usuário"
    size="xl"
    icon="fas fa-user">
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="userName">Nome</label>
                <input type="text" id="userName" name="users.name" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="userEmail">E-mail</label>
                <input type="email" id="userEmail" name="users.email" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="userPassword">Senha</label>
                <input type="password" id="userPassword" name="users.password" class="form-control">
            </div>
        </div>
    </div>

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="success" label="Salvar" onclick="adicionarUsuarioEstabelecimento()" />
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>