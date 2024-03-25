<div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nome">Nome <span class="asterisco">*</span></label>
        <x-adminlte-input id="nome" name="nome" placeholder="Nome do Estabelecimento" value="{{ $estabelecimento->nome ?? old('nome') }}" />
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
          <label for="tipo_pessoa_id">Tipo <span class="asterisco">*</span></label>
            <x-adminlte-select name="tipo_pessoa_id" id="tipo_pessoa_id" class="form-control" onchange="mudarMascaraNumeroDocumento(this)">
              <option value="">- Selecione -</option>
              @foreach($tipoPessoas as $tipoPessoa)
                <option {{ ($tipoPessoa->id == ($estabelecimento->tipo_pessoa_id ?? old("tipo_pessoa_id"))) ? "selected" : "" }} value="{{ $tipoPessoa->id }}">
                  {{ $tipoPessoa->nome }}
                </option>
              @endforeach
            </x-adminlte-select>
        </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="numero_documento">Nº Documento <span class="asterisco">*</span></label>
        <x-adminlte-input id="numero_documento" class="{{ ($estabelecimento->tipo_pessoa_id ?? 2) == 1 ? 'cpf' : 'cnpj' }}" name="numero_documento" placeholder="Nº do documento do Estabelecimento" value="{{ $estabelecimento->numero_documento ?? old('numero_documento') }}" />
      </div>
    </div>

  </div>

  <div class="row">
    
    <div class="col-md-4">
      <div class="form-group">
        <label for="razao_social">Razão Social</label>
        <x-adminlte-input id="razao_social" name="razao_social" placeholder="Razão Social" value="{{ $estabelecimento->razao_social ?? old('razao_social') }}" />
      </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
          <label for="nome_fantasia">Nome Fantasia</label>
          <x-adminlte-input id="nome_fantasia" name="nome_fantasia" placeholder="Nome Fantasia" value="{{ $estabelecimento->nome_fantasia ?? old('nome_fantasia') }}" />
        </div>
      </div>

    <div class="col-md-4">
      <div class="form-group">
          <label for="categoria_id">categoria <span class="asterisco">*</span></label>
            <x-adminlte-select name="categoria_id" id="categoria_id" class="form-control">
              <option value="">- Selecione -</option>
              @foreach($categorias as $categoria)
                <option {{ ($categoria->id == ($estabelecimento->categoria_id ?? old("categoria_id"))) ? "selected" : "" }} value="{{ $categoria->id }}">
                  {{ $categoria->nome }}
                </option>
              @endforeach
            </x-adminlte-select>
        </div>
    </div>

  </div>

  <div class="row">
    
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">E-mail <span class="asterisco">*</span></label>
        <x-adminlte-input type="email" name="email" id="email" placeholder="E-mail do Estabelecimento" value="{{ $estabelecimento->email ?? old('email') }}" />
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="senha">Senha <span class="asterisco"> <sub>* Apenas no cadastro</sub> </span></label>
        <x-adminlte-input type="password" name="senha" id="senha" placeholder="Senha de acesso do estabelecimento" />
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-4">
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <x-adminlte-input class="telefone" name="telefone" id="telefone" placeholder="Telefone" value="{{ $estabelecimento->telefone ?? old('telefone') }}" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
          <label for="whatsapp">Whatsapp</label>
          <x-adminlte-input class="telefone" name="whatsapp" id="whatsapp" placeholder="Whatsapp" value="{{ $estabelecimento->whatsapp ?? old('whatsapp') }}" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="nome_contato">Nome Contato</label>
            <x-adminlte-input name="nome_contato" placeholder="Nome Contato" value="{{ $estabelecimento->nome_contato ?? old('nome_contato') }}" />
        </div>
    </div>
      
  </div>

  <div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <x-adminlte-textarea name="descricao" id="descricao">
              {{ $estabelecimento->descricao ?? old('descricao') }}
            </x-adminlte-textarea>
          </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="situacao_estabelecimento_id">Situação do estabelecimento <span class="asterisco">*</span></label>
              <x-adminlte-select name="situacao_estabelecimento_id" id="situacao_estabelecimento_id" class="form-control">
                <option value="">- Selecione -</option>
                @foreach($situacoesEstabelecimento as $situacaoEstabelecimento)
                  <option {{ ($situacaoEstabelecimento->id == ($estabelecimento->situacao_estabelecimento_id ?? old("situacao_estabelecimento_id"))) ? "selected" : "" }} value="{{ $situacaoEstabelecimento->id }}">
                    {{ $situacaoEstabelecimento->nome }}
                  </option>
                @endforeach
              </x-adminlte-select>
        </div>
    </div>
      
  </div>