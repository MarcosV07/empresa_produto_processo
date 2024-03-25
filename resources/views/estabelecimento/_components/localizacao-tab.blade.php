<div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="cep">CEP <span class="asterisco">*</span></label>
        <x-adminlte-input id="cep" class="cep" name="cep" placeholder="CEP do Estabelecimento" value="{{ $estabelecimento->cep ?? old('cep') }}" />
      </div>
    </div>
    <div class="col-md-4 form-inline">
        <div class="form-group mt-3">
            <button type="button" class="btn btn-primary" onclick="carregarDadosViaCep();"><i class="fa fa-filter"></i> Pesquisar</button>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-md-3">
        <div class="form-group">
          <label for="logradouro">Logradrouro <span class="asterisco">*</span></label>
          <x-adminlte-input id="logradouro" name="logradouro" placeholder="Logradouro do Estabelecimento" value="{{ $estabelecimento->logradouro ?? old('logradouro') }}" onblur="buscaLatLong();"/>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
          <label for="bairro">Bairro <span class="asterisco">*</span></label>
          <x-adminlte-input id="bairro" name="bairro" placeholder="Bairro do Estabelecimento" value="{{ $estabelecimento->bairro ?? old('bairro') }}" onblur="buscaLatLong();"/>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
          <label for="cidade">Cidade <span class="asterisco">*</span></label>
          <x-adminlte-input id="cidade" name="cidade" placeholder="Cidade do Estabelecimento" value="{{ $estabelecimento->cidade ?? old('cidade') }}" onblur="buscaLatLong();"/>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
          <label for="estado">Estado <span class="asterisco">*</span></label>
          <x-adminlte-input id="estado" name="estado" placeholder="Estado do Estabelecimento" value="{{ $estabelecimento->estado ?? old('estado') }}" onblur="buscaLatLong();"/>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-5">
        <div class="form-group">
          <label for="complemento">Complemento</label>
          <x-adminlte-input id="complemento" name="complemento" placeholder="Complemento do Endereço" value="{{ $estabelecimento->complemento ?? old('complemento') }}" />
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group">
          <label for="referencia">Referência</label>
          <x-adminlte-input id="referencia" name="referencia" placeholder="Referência do Estabelecimento" value="{{ $estabelecimento->referencia ?? old('referencia') }}" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
          <label for="numero">Número <span class="asterisco">*</span></label>
          <x-adminlte-input id="numero" name="numero" placeholder="Nº do Estabelecimento" value="{{ $estabelecimento->numero ?? old('numero') }}" onblur="buscaLatLong();"/>
        </div>
    </div>

</div>

<input type="hidden" id="latitude" name="latitude" value="{{ $estabelecimento->latitude ?? old('latitude') }}">
<input type="hidden" id="longitude" name="longitude" value="{{ $estabelecimento->longitude ?? old('longitude') }}">

<div id="map" style="width: 100%; height: 300px;"></div>

