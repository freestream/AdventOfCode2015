<?php
$paths  = array();

function setup()
{
    global $paths;

    $paths  = array();
    $fp     = fopen('input', 'r');

    while (false !== ($line = fgets($fp))) {
        list($in, $out) = explode(' -> ', trim($line));
        $paths[$out] = $in;
    }
}

function getSignal($signal)
{
    global $paths;

    if (is_numeric($signal)) {
        return intval($signal);
    }

    $inst = explode(' ', $paths[$signal]);

    if (count($inst) == 1) {
        return getSignal($paths[$signal]);
    }

    if (count($inst) == 2) {
        list(, $a) = $inst;
        $paths[$signal] = 65535 - getSignal($a);
        return $paths[$signal];
    }

    list($a, $op, $b) = $inst;

    $a = getSignal($a);
    $b = getSignal($b);

    switch ($op) {
        case 'AND':
            $paths[$signal] = $a & $b;
            break;
        case 'OR':
            $paths[$signal] = $a | $b;
            break;
        case 'LSHIFT':
            $paths[$signal] = $a << $b;
            break;
        case 'RSHIFT':
            $paths[$signal] = $a >> $b;
            break;
    }

    return $paths[$signal];
}

setup();
$a = getSignal('a');

setup();
$paths['b'] = $data;
$b = getSignal('a');

echo "The signal from 'a' ultimately ends up in {$a} and after some overriding it ends up in {$b}";

