<?php

if (! function_exists('moneyToFloat')) {
    function moneyToFloat($valor) {
        $conversao = 0;
        if (!empty($valor)) {
            $procurado = array(".", ",");
            $trocar_por = array("", ".");
            $conversao = str_replace($procurado, $trocar_por, $valor);
        }
        return $conversao;
    }
}

if (! function_exists('floatToMoney')) {
    function floatToMoney($valor, $decimais = 2, $dlmt_decimais = ',', $dlmt_milhar = '.') {
        if (!empty($valor)) {
            $valor = number_format($valor, $decimais, $dlmt_decimais, $dlmt_milhar);
        }
        return $valor;
    }
}