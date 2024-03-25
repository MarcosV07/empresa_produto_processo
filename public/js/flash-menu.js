function mascararElementos() {
    $('.date').mask('00/00/0000');

    var mask = "HH:MM",
        pattern = {
            'translation': {
                'H': {
                    pattern: /[0-2]/
                },
                'h': {
                    pattern: /[0-9]/
                },
                'M': {
                    pattern: /[0-5]/
                },
                'm': {
                    pattern: /[0-9]/
                }
            }
        };
    $('.horario').mask("Hh:Mm", pattern);

    //$('.horario').mask('00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.telefone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.cnpj').mask('00.000.000/0000-00', { reverse: true });
    $('.money').mask('000.000.000.000.000,00', { reverse: true });
    $('.money2').mask("#.##0,00", { reverse: true });
}

$(document).ready(function() {
    mascararElementos();
});