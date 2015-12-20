<?php
$fp         = fopen('input', 'r');
$suesOne    = array();

while (false !== ($line = fgets($fp))) {
    preg_match('/(\w+):\s(\d+),\s(\w+):\s(\d+),\s(\w+):\s(\d+)/', trim($line), $matches);

    $suesOne[] = array(
        $matches[1] => intval($matches[2]),
        $matches[3] => intval($matches[4]),
        $matches[5] => intval($matches[6]),
    );
}

$suesTwo    = $suesOne;
$properties = array(
    'children'      => 3,
    'cats'          => 7,
    'samoyeds'      => 2,
    'pomeranians'   => 3,
    'akitas'        => 0,
    'vizslas'       => 0,
    'goldfish'      => 5,
    'trees'         => 3,
    'cars'          => 2,
    'perfumes'      => 1
);

foreach ($properties as $propertie => $value) {
    foreach ($suesTwo as $id => $sue) {
        if (!isset($sue[$propertie])) {
            continue;
        }

        if (in_array($propertie, array('cats', 'trees'))) {
            if ($sue[$propertie] < $value) {
                unset($suesTwo[$id]);
            }
        } elseif (in_array($propertie, array('pomeranians', 'goldfish'))) {
            if ($sue[$propertie] > $value) {
                unset($suesTwo[$id]);
            }
        } else {
            if ($sue[$propertie] != $value) {
                unset($suesTwo[$id]);
            }
        }
    }

    foreach ($suesOne as $id => $sue) {
        if (!isset($sue[$propertie])) {
            continue;
        }

        if ($sue[$propertie] != $value) {
            unset($suesOne[$id]);
        }
    }
}

$a = key($suesOne)+1;
$b = key($suesTwo)+1;

echo "The Sue we are looking for is nr {$a} but after realizing the huge error in the result the answer changed to {$b}";

