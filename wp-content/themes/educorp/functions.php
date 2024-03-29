<?php

define('SITEPATH', '/wp-content/themes/educorp/');

function contador()
{
    function _date($format, $timezone)
    {
        $timestamp = false;
        $defaultTimeZone = 'UTC';
        if (date_default_timezone_get() != $defaultTimeZone) date_default_timezone_set($defaultTimeZone);
        $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
        $gmtTimezone = new DateTimeZone('GMT');
        $myDateTime = new DateTime(($timestamp != false ? date("r", (int)$timestamp) : date("r")), $gmtTimezone);
        $offset = $userTimezone->getOffset($myDateTime);
        return date($format, ($timestamp != false ? (int)$timestamp : $myDateTime->format('U')) + $offset);
    }

    $contador = 'contador';
    $visitas = 'visitas';
    function ler($path)
    {
        $arquivo = fopen($path, 'r');
        $linha = fgets($arquivo);
        fclose($arquivo);
        return $linha;
    }
    function escrever($path, $texto, $modo)
    {
        $arquivo = fopen($path, $modo);
        fwrite($arquivo, $texto . "\n");
        fclose($arquivo);
    }
    echo ler($contador);
    $n = (int)ler($contador);
    $n++;
    escrever($contador, $n, 'w');
    escrever($visitas, _date("d-m-Y, H:i:s", 'America/Sao_Paulo') . " : " . $_SERVER['REMOTE_ADDR'], 'a+');
}
add_action('contador', 'contador');