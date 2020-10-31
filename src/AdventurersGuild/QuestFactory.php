<?php

namespace AdventurersGuild;

use Config\QuestConfig;
use AdventurersGuild\Dice;

class QuestFactory
{
    public function generateQuestStats() {
        // if ($dcRoll) { // @todo test
        //     $dc = dcRoll();
        // } else {
            $dc = Dice::roll(2,10,5); // 2d10 + 5
        // }

        $difficulty = '';
        if ($dc <= QuestConfig::MAX_DC_EASY) {
            $difficulty = 'easy';
        } elseif ($dc <= QuestConfig::MAX_DC_MEDIUM) {
            $difficulty = 'medium';
        } elseif ($dc <= QuestConfig::MAX_DC_HARD) {
            $difficulty = 'hard';
        } else {
            $difficulty = 'very hard';
        }

        $cash = 0;
        $loReward = 0;
        $hiReward = 0;
        if ($difficulty == 'easy') {
            $lo = QuestConfig::DC_EASY_CASH[0];
            $hi = QuestConfig::DC_EASY_CASH[1];
        } elseif ($difficulty == 'medium') {
            $lo = QuestConfig::DC_MEDIUM_CASH[0];
            $hi = QuestConfig::DC_MEDIUM_CASH[1];
        } elseif ($difficulty == 'hard') {
            $lo = QuestConfig::DC_HARD_CASH[0];
            $hi = QuestConfig::DC_HARD_CASH[1];
        } else {
            $lo = QuestConfig::DC_VERY_HARD_CASH[0];
            $hi = QuestConfig::DC_VERY_HARD_CASH[1];
        }

        $cash = rand($lo, $hi);

        $peculiar = Dice::roll(3,10);
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
}
