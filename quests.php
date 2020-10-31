<?php

function roll($numDice, $faces, $modifier = 0) {
    $total = 0;
    for ($i = 1; $i <= $numDice; $i++) {
        $roll = rand(1, $faces);
        $total += $roll;
    }

    return $total + $modifier;
}


// inclusive cap
const MAX_DC_EASY = 15;
const MAX_DC_MEDIUM = 20;
const MAX_DC_HARD = 25;

const DC_EASY_CASH = [50, 300]; // LO, HI
const DC_MEDIUM_CASH = [300, 800];
const DC_HARD_CASH = [800, 1200];
const DC_VERY_HARD_CASH = [1200, 1500];



function generateQuestStats(callback $dcRoll = null) {
    if ($dcRoll) { // @todo test
        $dc = dcRoll();
    } else {
        $dc = roll(2,10,5); // 2d10 + 5
    }

    $difficulty = '';
    if ($dc <= MAX_DC_EASY) {
        $difficulty = 'easy';
    } elseif ($dc <= MAX_DC_MEDIUM) {
        $difficulty = 'medium';
    } elseif ($dc <= MAX_DC_HARD) {
        $difficulty = 'hard';
    } else {
        $difficulty = 'very hard';
    }

    $cash = 0;
    $loReward = 0;
    $hiReward = 0;
    if ($difficulty == 'easy') {
        $lo = DC_EASY_CASH[0];
        $hi = DC_EASY_CASH[1];
    } elseif ($difficulty == 'medium') {
        $lo = DC_MEDIUM_CASH[0];
        $hi = DC_MEDIUM_CASH[1];
    } elseif ($difficulty == 'hard') {
        $lo = DC_HARD_CASH[0];
        $hi = DC_HARD_CASH[1];
    } else {
        $lo = DC_VERY_HARD_CASH[0];
        $hi = DC_VERY_HARD_CASH[1];
    }

    $cash = rand($lo, $hi);

    $peculiar = roll(3,10);
    if ($peculiar < 14 && $peculiar % 2 == 0) {
        // - peculiar;
        $cash = $cash * 0.5;
    }

    if ($peculiar < 14 && $peculiar % 2 != 0) {
        // +peculiar
        $cash = $cash * 1.5;
    }

    return [$dc, $cash];
}

function runQuests() {
    $numQuests = 5;
    $sum = 0;
    for ($j=1; $j <= $numQuests; $j++) {
            list($difficulty, $cash) = generateQuestStats();
            $cash = round($cash);
            $sum += $cash;
            # echo sprintf("DC: %s, Cash: %s", $difficulty, $cash) . '<br>';
            # echo $cash . "<br>";
    }

    return $sum;
}


# runQuests();
function runCycles() {
     $cycles = 1000;
     for ($i=1; $i <= $cycles; $i++) {
         echo runQuests() . "<br>";
     }
}

echo runCycles();
