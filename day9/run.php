<?php
$fp             = fopen('input', 'r');
$routes         = array();
$locations      = array();
$permutations   = array();

while (false !== ($line = fgets($fp))) {
    list($a,, $b,,$c) = explode(' ', trim($line));
    $routes[$a][$b] = $c;
    $routes[$b][$a] = $c;

    $locations[$a] = null;
    $locations[$b] = null;
}

function permutations($items, $perms = array())
{
    global $permutations;

    if (empty($items)) {
        $permutations[] = join(',', $perms);
    }  else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             permutations($newitems, $newperms);
         }
    }
}

function getShortestAndLongestRoute()
{
    global $permutations;
    global $locations;
    global $routes;

    $shortest   = false;
    $longest    = false;

    foreach ($permutations as $possibility) {
        $destinations = explode(',', $possibility);

        if (!empty(array_diff($destinations, $locations))) {
            continue;
        }

        $total  = 0;
        $fail   = false;

        $dests = explode(',', $possibility);

        $from = reset($dests);
        array_shift($dests);

        foreach ($dests as $to) {
            if (!isset($routes[$from][$to])) {
                $fail = true;
                break;
            }

            $total  += $routes[$from][$to];
            $from   = $to;
        };

        if ($fail == false && ($total < $shortest || $shortest == false)) {
            $shortest = $total;
        }

        if ($fail == false && ($total > $longest || $longest == false)) {
            $longest = $total;
        }
    }

    return array($longest, $shortest);
}

$locations = array_keys($locations);
permutations($locations);

list($longest, $shortest) = getShortestAndLongestRoute();

echo "The shortest route for Sata is {$shortest} and the longest is {$longest}";
