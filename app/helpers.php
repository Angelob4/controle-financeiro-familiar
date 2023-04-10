<?php

/**
 * converte os valores informados para formato R$ xx.xxx,xx
 */
function toBrMoney($value){
    $value = str_replace(',', '.', str_replace('.', '', $value));
    $value_formated = number_format($value, 2, ',', '.');
    return 'R$ ' . $value_formated;
}


function brToDouble($value) {
    $valueWithoutDot = str_replace('.', '', $value);
    $valueWithDot = str_replace(',', '.', $valueWithoutDot);
    return (double) $valueWithDot;
  }
