<?php
$fp             = fopen('input', 'r');
$reindeers      = array();
$times          = array();

while (false !== ($line = fgets($fp))) {
    preg_match('/^(\w+).*fly\s(\d+)\s[\w\/]+\sfor\s(\d+).*for\s(\d+)/', trim($line), $matches);
    list(,$a, $b, $c, $d) = $matches;

    $reindeers[$a] = array(
        'speed'     => $b,
        'duration'  => $c,
        'rest'      => $d,
    );
}

$seconds    = 2503;
$points     = array_fill_keys(array_keys($reindeers), 0);

for ($i = 1; $i <= $seconds; $i++) {
    foreach ($reindeers as $name => $reindeer) {
        $a = $reindeer['speed'];
        $b = $reindeer['duration'];
        $c = $reindeer['rest'];
        $m = $b + $c;

        $times[$name] = intval((floor($i/($m)))*$a*$b) + (min($b, $i % $m)*$a);
    }

    $e = array();
    $f = 0;

    foreach ($times as $name => $time) {
        if ($time > $f) {
            $f = $time;
            $e = array($name);
        } elseif ($time == $f) {
            $e[] = $name;
        }
    }

    foreach ($e as $name) {
        $points[$name] += 1;
    }
}

arsort($times);
arsort($points);

$a = reset($times);
$b = key($times);
$c = reset($points);
$d = key($points);

echo "The winning reindeer was {$b} by a distance of {$a} but {$d} won with {$c} points.";

