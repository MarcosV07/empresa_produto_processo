function carregarTelasPerfil(este) {
    var perfil = $(este).val();
    if (perfil) {
        $.ajax({
            url: $("#formPerfisAssociacao").attr("action"),
            method: "POST",
            dataType: "JSON",
            data: $("#formPerfisAssociacao").serialize(),
            beforeSend: function() {
                $('#loader').removeClass('hidden');
                $(".checkbox-tela").prop("checked", false);
            },
            success: function(retorno) {
                $(retorno).each(function(chave, idTela) {
                    $("#tela_id_" + idTela).prop("checked", true);
                });
            },
            error: function() {
                $('#loader').addClass('hidden');
            },
            complete: function() {
                $('#loader').addClass('hidden');
            }
        })
    } else {
        $(".checkbox-tela").prop("checked", false);
    }
}

function associarPerfilTela(este) {
    var idTela = $(este).val();
    var idPerfil = $("#perfil_id").val();
    $("#pt_tela_id").val(idTela);
    $("#pt_perfil_id").val(idPerfil);
    if (idTela && idPerfil) {
        $.ajax({
            url: $("#formPerfilTelaAssociar").attr("action"),
            method: "POST",
            dataType: "JSON",
            data: $("#formPerfilTelaAssociar").serialize(),
            beforeSend: function() {
                $('#loader').removeClass('hidden');
            },
            success: function(retorno) {
                if (retorno.ok) {
                    toastr.success(retorno.msg);
                } else {
                    toastr.error(retorno.msg);
                }
            },
            error: function() {
                $('#loader').addClass('hidden');
            },
            complete: function() {
                $('#loader').addClass('hidden');
            }
        })
    } else {
        toastr.warning("Por favor, selecione o perfil.");
    }
}