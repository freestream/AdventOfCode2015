<?php
$fp     = fopen('input', 'r');
$pos    = array('x' => 0, 'y' => 0);
$poses  = array_fill_keys(array(0, 1), $pos);
$visit  = array('0,0' => 1);
$visits = array($visit, $visit);
$turns  = 0;

while (false !== ($char = fgetc($fp))) {
    if (!($char = trim($char))) {
        continue;
    }

    $turn = ($turns % 2) ? 1 : 0;

    switch ($char) {
        case '^':
            $poses[$turn]['y']++;
            $pos['y']++;
            break;
        case 'v':
            $poses[$turn]['y']--;
            $pos['y']--;
            break;
        case '>':
            $poses[$turn]['x']++;
            $pos['x']++;
            break;
        case '<':
            $poses[$turn]['x']--;
            $pos['x']--;
            break;
    }

    extract($pos);

    $cord = "{$x},{$y}";

    if (!isset($visit[$cord])) {
        $visit[$cord] = 0;
    }

    $visit[$cord]++;

    extract($poses[$turn]);

    $cord = "{$x},{$y}";

    if (!isset($visits[$turn][$cord])) {
        $visits[$turn][$cord] = 0;
    }

    $visits[$turn][$cord]++;
    $turns++;
}

$visits = array_unique(
    array_merge(
        array_keys($visits[0]),
        array_keys($visits[1])
    )
);

$rTotal = count($visits);
$aTotal = count($visit);

echo "Santa alone delivererd presents to {$aTotal} houses and with help of Robo-Santa a total of {$rTotal} houses receive at least one present.";

