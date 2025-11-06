<?php

$MAIN_MENUS = [
    'main' => 'ROOMS',
    'checked' => 'FAVORITES',
    'checked_edit' => 'SETTINGS',
    'back' => 'BACK'
];

$CONTOL_LABELS = [
    1 => 'LIGHT',
    2 => '',
    3 => 'SOCKET',
    4 => 'THERMOMETER',
    5 => 'THERMOSTAT',
    6 => '',
    7 => 'VENTING',
    8 => '',
    9 => '',
    10 => 'HUMIDITY',
    11 => 'CO',
    12 => '',
    13 => 'Atm. Pressure',
    14 => 'CURRENCY',
];

$CHART_UPDATE_INTERVAL = 60 * 1000; // Время обновления графиков

function checkHttpPath($file)
{
    print_r($_SERVER);
}

function decodeAppControl($app_control)
{
    $control = '';
    $typ = -1; // 1-label; 2-switch; 3-track;
    $resolution = '';
    $varMin = 0;
    $varMax = 10;
    $varStep = 1;
    switch ($app_control) {
        case 1: // Light
            $control = 'LIGHT';
            $typ = 2;
            break;
        case 3: // SOcket
            $control = '';
            $typ = 2;
            break;
        case 4: // Thermometr
            $control = 'THERMOMETR';
            $typ = 1;
            $resolution = '°C';
            break;
        case 5: // Thermostat
            $control = 'THERMOSTAT';
            $typ = 3;
            $resolution = '°C';
            $varMin = 15;
            $varMax = 30;
            $varStep = 1;
            break;
        case 7: //Venting
            $control = 'VENTING';
            $typ = 3;
            $resolution = '%';
            $varMin = 0;
            $varMax = 100;
            $varStep = 10;
            break;
        case 10: //Humidity
            $control = 'HUMIDITY';
            $typ = 1;
            $resolution = '%';
            break;
        case 11: // Gas Sensor
            $control = 'CO';
            $typ = 1;
            $resolution = 'ppm';
            break;
        case 13: // Atm. pressure
            $control = '';
            $typ = 1;
            $resolution = 'mm';
            break;
        case 14: // Currency Sensor
            $control = 'CURRENCY';
            $typ = 1;
            $resolution = 'A';
            break;
    }

    return [
        'label' => $control,
        'typ' => $typ,
        'resolution' => $resolution,
        'varMin' => $varMin,
        'varMax' => $varMax,
        'varStep' => $varStep
    ];
}

function groupVariableName($groupName, $variableName, $appControlLabel)
{
    $resLabel = '';
    if ($appControlLabel != '') {
        $resLabel = $appControlLabel . ' ';
    }
    return $resLabel . mb_strtoupper(str_replace($groupName, '', $variableName));
}
