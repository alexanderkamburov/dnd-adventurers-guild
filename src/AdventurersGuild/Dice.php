<?php

namespace AdventurersGuild;

class Dice
{
    static public function roll($numDice, $faces, $modifier = 0) {
        $total = 0;
        for ($i = 1; $i <= $numDice; $i++) {
            $roll = rand(1, $faces);
            $total += $roll;
        }

        return $total + $modifier;
    }
}
