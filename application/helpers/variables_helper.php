<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function convert_null($variable)
{

    if (empty($variable)) {
        $variable = NULL;
    }

    return $variable;
}

function convert_age($fechanacimiento, $fecha = NULL)
{

    if (empty($fecha)) {
        $ano_a = date("Y");
        $mes_a = date("m");
        $dia_a = date("d");
    } else {
        list($ano_a, $mes_a, $dia_a) = explode("-", $fecha);
    }

    list($ano, $mes, $dia) = explode("-", $fechanacimiento);
    $ano_diferencia = $ano_a - $ano;
    $mes_diferencia = $mes_a - $mes;
    $dia_diferencia = $dia_a - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}

function convert_date($fecha = '')
{

    if (empty($fecha)) {
        return NULL;
    } else {
        return date('d/m/Y', strtotime($fecha));
    }
}

function convert_date2($fecha)
{

    if (empty($fecha)) {
        return NULL;
    } else {
        return implode("-", array_reverse(explode("/", $fecha)));
    }
}

function convert_complete_age($fecha_nacimiento, $fecha_actual = '')
{

    if (empty($fecha_actual)) {
        $fecha_actual = date('d/m/Y');
    }

    // separamos en partes las fechas 
    $array_nacimiento = explode("/", $fecha_nacimiento);
    $array_actual = explode("/", $fecha_actual);

    $anos = $array_actual[2] - $array_nacimiento[2]; // calculamos años 
    $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
    $dias = $array_actual[0] - $array_nacimiento[0]; // calculamos días 
    //ajuste de posible negativo en $días 
    if ($dias < 0) {
        --$meses;

        //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
        switch ($array_actual[1]) {
            case 1:
                $dias_mes_anterior = 31;
                break;
            case 2:
                $dias_mes_anterior = 31;
                break;
            case 3:
                if (bisiesto($array_actual[2])) {
                    $dias_mes_anterior = 29;
                    break;
                } else {
                    $dias_mes_anterior = 28;
                    break;
                }
            case 4:
                $dias_mes_anterior = 31;
                break;
            case 5:
                $dias_mes_anterior = 30;
                break;
            case 6:
                $dias_mes_anterior = 31;
                break;
            case 7:
                $dias_mes_anterior = 30;
                break;
            case 8:
                $dias_mes_anterior = 31;
                break;
            case 9:
                $dias_mes_anterior = 31;
                break;
            case 10:
                $dias_mes_anterior = 30;
                break;
            case 11:
                $dias_mes_anterior = 31;
                break;
            case 12:
                $dias_mes_anterior = 30;
                break;
        }

        $dias = $dias + $dias_mes_anterior;

        if ($dias < 0) {
            --$meses;
            if ($dias == -1) {
                $dias = 30;
            }
            if ($dias == -2) {
                $dias = 29;
            }
        }
    }

    //ajuste de posible negativo en $meses 
    if ($meses < 0) {
        --$anos;
        $meses = $meses + 12;
    }

    $tiempo[0] = $anos;
    $tiempo[1] = $meses;
    $tiempo[2] = $dias;

    return $tiempo;
}

function bisiesto($anio_actual)
{
    $bisiesto = false;
    //probamos si el mes de febrero del año actual tiene 29 días 
    if (checkdate(2, 29, $anio_actual)) {
        $bisiesto = true;
    }
    return $bisiesto;
}

function unit_age($val)
{

    if ($val[0] === 0) {

        if ($val[1] === 0) {

            $unit[0] = $val[2];
            $unit[1] = 'D';

            return $unit;
        } else {

            $unit[0] = $val[1];
            $unit[1] = 'M';

            return $unit;
        }
    } else {

        $unit[0] = $val[0];
        $unit[1] = 'A';

        return $unit;
    }
}

function randomText($length)
{
    $key = "";
    $pattern = "1234567890abcdef";
    for ($i = 0; $i < $length; $i++) {
        $key .= $pattern{
        rand(0, 15)};
    }
    return $key;
}

function ver_status($valor)
{
    if ($valor == '1') {
        $result = "Activo";
    } else {
        $result = "Inactivo";
    }
    return $result;
}

// function icono($estatus)
// {
//     if ($estatus == 0) {
//         return  '$table_button = array(
//                 array("desactivar", "Desactivar/activar", "btn btn-block btn-success btn-sm", "fas fa-user-check", "")';
//     } else {
//         return 'array("desactivar", "Desactivar/activar", "btn btn-block btn-sm bg-gradient-warning", "fas fa-user-times", "")';
//     }
// }
