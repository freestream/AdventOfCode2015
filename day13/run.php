<?php
$fp             = fopen('input', 'r');
$happiness      = array();
$names          = array();
$permutations   = array();

while (false !== ($line = fgets($fp))) {
    preg_match('/^(\w+).*(lose|gain)\s(\d+).*to\s(\w+)\.$/', trim($line), $matches);

    list(,$a, $b, $c, $d) = $matches;
    $happiness[$a][$d] = ($b == 'lose') ? (int) -$c : (int) $c;

    $names[$a] = null;
    $names[$d] = null;
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

function resetAndAddMe()
{
    global $permutations;
    global $happiness;
    global $names;

    $permutations = array();

    foreach ($names as $name) {
        $happiness[$name]['Anton'] = 0;
        $happiness['Anton'][$name] = 0;
    }

    $names[] = 'Anton';
    permutations($names);
}

function getOptionalHappiness()
{
    global $permutations;
    global $happiness;
    global $names;

    $maximun    = null;
    $count      = ((count($names)-1));

    foreach ($permutations as $possibility) {
        $arrangement    = explode(',', $possibility);
        $total          = 0;

        for ($i = 0; $i < $count; $i+=2) {
            $p = 0;
            $a = $arrangement[$i];
            $b = ($i == 0) ? $arrangement[$count] : $arrangement[$i-1];
            $c = ($i == $count) ? $arrangement[0] : $arrangement[$i+1];

            $p += ($happiness[$a][$b] + $happiness[$a][$c]);
            $p += ($happiness[$b][$a] + $happiness[$c][$a]);

            $total += $p;
        }

        if ($maximun == null || $total > $maximun) {
            $maximun = $total;
        }
    }

    return $maximun;
}

$names = array_keys($names);
permutations($names);

$a = getOptionalHappiness();
resetAndAddMe();
$b = getOptionalHappiness();

echo "At a optimal state it will be combined happiness of {$a} and we include myself in the mix it will be a combined happiness if {$b}";
