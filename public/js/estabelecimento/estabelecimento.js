var map;
var marker;

function mudarMascaraNumeroDocumento(tipo) {
    var tipoPessoa = $(tipo).val();
    if (tipoPessoa) {
        $("#numero_documento").val("");
        if (tipoPessoa == 1) { // Pessoa Física
            $("#numero_documento").removeClass("cnpj");
            $("#numero_documento").addClass("cpf");
            $('.cpf').mask('000.000.000-00', { reverse: true });
        } else { // Pessoa Jurídica
            $("#numero_documento").removeClass("cpf");
            $("#numero_documento").addClass("cnpj");
            $('.cnpj').mask('00.000.000/0000-00', { reverse: true });
        }
    }
}

function limparCamposEndereco() {
    $("#logradouro").val("");
    $("#bairro").val("");
    $("#estado").val("");
    $("#cidade").val("");
}

function carregarDadosViaCep() {

    var cep = $("#cep").val().replace(/\D/g, '').trim();
    if (cep) {

        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {

            $("#logradouro").val("");
            $("#bairro").val("...");
            $("#estado").val("...");
            $("#cidade").val("...");

            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#estado").val(dados.uf);
                    $("#cidade").val(dados.localidade);

                    buscaLatLong();

                } else {
                    limparCamposEndereco();
                    toastr.warning("Formato de CEP inválido.");
                }
            });
        } else {
            limparCamposEndereco();
            toastr.error("Formato de CEP inválido.");
        }
    }
}

function adicionarHorarioFuncionamento() {
    var dias = $('.dia:checked');
    if (dias.length > 0) {

        var diasSelecionados = [];
        dias.each(function() {
            diasSelecionados.push(parseInt($(this).val()));
        });

        var horario_inicio = $("#dia_estabelecimentos_horario_inicio").val().trim();
        var horario_fim = $("#dia_estabelecimentos_horario_fim").val().trim();

        if (horario_inicio && horario_fim) {

            var campoOculto = "";
            var idDia = 0;
            var faixaHorario = "";
            var linkExclusao = "";
            dias.each(function() {
                idDia = $(this).val();
                faixaHorario = (horario_inicio + "-" + horario_fim);
                campoOculto = "<input type='hidden' name='dia_estabelecimentos[][" + idDia + "]' value='" + faixaHorario + "' />";
                linkExclusao = " <a href='javascript:void(0)' onclick='excluirHorario(this)' class='text-danger'><i class='fas fa-trash'></i> </a>";
                $("#lDia" + idDia).append("<li>" + faixaHorario + linkExclusao + campoOculto + "</li>");
            });

            // Limpeza dos campos
            $(".dia").prop("checked", false);
            $("#dia_estabelecimentos_horario_inicio").val("");
            $("#dia_estabelecimentos_horario_fim").val("");
            $("#modalAdicionarHorario").modal("hide");
        } else {
            toastr.warning("Necessário informar o horário de início e fim.");
        }
    } else {
        toastr.warning("Selecione ao menos um dia.");
    }
}

function exibirHorario(idDia, faixaHorario) {
    var campoOculto = "<input type='hidden' name='dia_estabelecimentos[][" + idDia + "]' value='" + faixaHorario + "' />";
    var linkExclusao = " <a href='javascript:void(0)' onclick='excluirHorario(this)' class='text-danger'><i class='fas fa-trash'></i> </a>";
    $("#lDia" + idDia).append("<li>" + faixaHorario + linkExclusao + campoOculto + "</li>");
}

function excluirHorario(e) {
    $(e).parents("li").remove();
}

function marcarBairros(e) {
    if ($(e).prop("checked")) {
        $(".bairro").prop("checked", true);
    } else {
        $(".bairro").prop("checked", false);
    }
}

function carregarBairros(estado = "", cidade = "", latitude = "", longitude = "") {

    if (estado == "") {
        estado = $("#estado").val();
    }

    if (cidade == "") {
        cidade = $("#cidade").val();
    }

    if (latitude == "") {
        latitude = $("#latitude").val();
    }

    if (longitude == "") {
        longitude = $("#longitude").val();
    }

    $.ajax({
        url: $("#frmObterBairrosPorCidade").attr("action"),
        method: "POST",
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "idEstabelecimento": $("#idEstabelecimento").val(),
            "estado": estado,
            "cidade": cidade,
            "latitude": latitude,
            "longitude": longitude
        },
        beforeSend: function() {
            $('#loader').removeClass('hidden');
        },
        success: function(retorno) {
            if (retorno.ok) {
                $("#corpoTabelaValoreEntrega").empty();
                if (retorno.bairros.length > 0) {
                    $("#alertaBairroNaoHabilitado").hide();
                    var valoresBairros = retorno.valoresBairros;

                    $(retorno.bairros).each(function(_, bairro) {
                        var idBairro = bairro.id;
                        var valor = "";
                        if (valoresBairros[idBairro] != undefined) {
                            valor = valoresBairros[idBairro];
                        }
                        var linha = "<tr>";
                        //linha += "<td scope='row'><input type='checkbox' class='bairro' name='bairro_estabelecimento[" + bairro.id + "][id]' id='Bairro" + bairro.id + "' value='" + bairro.id + "' checked='true' /></td>";
                        linha += "<td><label for='Bairro" + idBairro + "' style='font-weight: normal; cursor: pointer;'>" + bairro.bairro + "</label></td>";
                        linha += "<td><input type='text' class='form-control money' name='bairro_estabelecimento[" + idBairro + "][valor_entrega]' placeholder='0,00' value='" + valor + "' /></td>";
                        linha += "</tr>";
                        $("#corpoTabelaValoreEntrega").append(linha);
                    });
                }
            }
        },
        error: function() {
            $('#loader').addClass('hidden');
        },
        complete: function() {
            $('#loader').addClass('hidden');
        }
    });
}

/**
 * Adiciona um novo usuário para ter acesso a manter os dados do estabelecimento
 * @returns void
 */
function adicionarUsuarioEstabelecimento() {

    var nome = $("#userName").val().trim();
    var email = $("#userEmail").val().trim();
    var senha = $("#userPassword").val().trim();

    if (nome == "") {
        toastr.warning("Por favor, informe o nome do usuário.");
        return;
    }

    if (email == "") {
        toastr.warning("Por favor, informe o e-mail do usuário.");
        return;
    }

    if (senha == "") {
        toastr.warning("Por favor, informe a senha do usuário.");
        return;
    }

    var chave = $(".linha-usuario").length;

    var camposOcultos = "<input class='usuario-estabelecimento' type='hidden' name='usuarios_estabelecimento[" + chave + "][name]' value='" + nome + "' />";
    camposOcultos += "<input type='hidden' name='usuarios_estabelecimento[" + chave + "][email]' value='" + email + "' />";
    camposOcultos += "<input type='hidden' name='usuarios_estabelecimento[" + chave + "][password]' value='" + senha + "' />";

    var acaoExcluirUsuarioEstabelecimento = "<a class='text-danger' href='javascript:void(0);' onclick='$(\".linha-usuario-" + chave + "\").parents(\"tr\").remove();'><i class='fas fa-trash'></i> Remover</a>";

    var linhaNovoUsuario = "<tr>";
    linhaNovoUsuario += "<td class='linha-usuario linha-usuario-" + chave + "'>" + camposOcultos + nome + "</td>";
    linhaNovoUsuario += "<td>" + email + "</td>"
    linhaNovoUsuario += "<td>" + acaoExcluirUsuarioEstabelecimento + "</td>"
    linhaNovoUsuario += "</tr>";

    $("#corpoTabelaUsuariosEstabelecimento").append(linhaNovoUsuario);
    $("#userName").val("");
    $("#userEmail").val("");
    $("#userPassword").val("");
    $("#modalAdicionarUsuarioEstabelecimento").modal("hide");
}

function ativarDesativarAcessoUsuarioEstabelecimento(e, idUser) {
    var ativo = $(e).prop("checked");
    $.ajax({
        url: $("#frmAtivarDesativarAcessoUsuarioEstabelecimento").attr("action"),
        method: "POST",
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "ativo": ativo,
            "idUser": idUser
        },
        beforeSend: function() {
            $('#loader').removeClass('hidden');
        },
        success: function(retorno) {
            if (retorno.ok) {
                toastr.success(retorno.msg);
            } else {
                toastr.warning(retorno.msg);
            }
        },
        error: function() {
            $('#loader').addClass('hidden');
        },
        complete: function() {
            $('#loader').addClass('hidden');
        }
    });
}


$(document).ready(function() {
    // Seleciona o valor padrão caso o tipo de pessoa não exista
    var tipoPessa = $("#tipo_pessoa_id").val();
    if (!tipoPessa) {
        $("#tipo_pessoa_id").val(2);
    }
    
    // Seleção da aba para exibir o erro de validação (caso exista)
    if ($(".invalid-feedback").length > 0) {
        $(".invalid-feedback").each(function(chave, elemento) {
            var idTab = $(elemento).parents("div[role='tabpanel']").attr("id");
            $('#estabelecimento-tab a[href="#' + idTab + '"]').tab('show');
            return;
        });
    }
});

function buscaLatLong() {
    var cidade = $("#cidade").val() != '' ? $("#cidade").val() : '';
    var bairro = $("#bairro").val() != '' ? $("#bairro").val() : '';

    setTimeout(() => {
        var dadosContat = cidade+'%20'+bairro;
        $.ajax({
            url: $("#frmObterLatitudeLongitude").attr("action"),
            method: "POST",
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "dadosEndereco": dadosContat,
            },
            success: function(retorno) {
                if(retorno?.status == 'ok'){
                    var latitude = retorno.results[0].geometry.location.lat;
                    var longitude = retorno.results[0].geometry.location.lng;

                    initMap(latitude,longitude, 16);

                    $("#latitude").val(parseFloat(latitude).toFixed(7));
                    $("#longitude").val(parseFloat(longitude).toFixed(7));
                }
            },
        });
    }, 500);
}

function initMap(latitude = null ,longitude = null, zoom = 15) {
    $("#map").empty();
    latitude = latitude ? latitude : -12.9707828;
    longitude = longitude ? longitude : -38.5127416;

    const iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.transform([longitude,latitude], 'EPSG:4326', 'EPSG:3857')),
        name: 'Null Island',
        population: 4000,
        rainfall: 500,
    });

    const iconStyle = new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: `${base_url()}vendor/adminlte/dist/img/icon_locale.png`,
        }),
    });

    iconFeature.setStyle(iconStyle);

    const vectorSource = new ol.source.Vector({
        features: [iconFeature],
    });

    const vectorLayer = new ol.layer.Vector({
        source: vectorSource,
    });

    const rasterLayer = new ol.layer.Tile({
        source: new ol.source.OSM(),
    });

    const target = document.getElementById('map');
        const map = new ol.Map({
            layers: [rasterLayer, vectorLayer],
            target: target,
            view: new ol.View({
                center: ol.proj.transform([longitude,latitude], 'EPSG:4326', 'EPSG:3857'),
                zoom: zoom,
            }),
    });

    const modify = new ol.interaction.Modify({
        hitDetection: vectorLayer,
        source: vectorSource,
    });

    modify.on(['modifystart', 'modifyend'], function (evt) {
        target.style.cursor = evt.type === 'modifystart' ? 'grabbing' : 'pointer';
    });

    const overlaySource = modify.getOverlay().getSource();
    overlaySource.on(['addfeature', 'removefeature'], function (evt) {
        target.style.cursor = evt.type === 'addfeature' ? 'pointer' : '';
    });

    map.addInteraction(modify);

    map.on('pointerdrag', function(evt) {
        var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
        var lat = lonlat[1];
        var lon = lonlat[0];

        $("#latitude").val(lat.toFixed(7));
        $("#longitude").val(lon.toFixed(7));
    });
}

function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/')+'/';
    }else{
        var url = location.origin +'/';
    }

    return url;
}