<?php

namespace AdventurersGuild;

use Config\Config;
use AdventurersGuild\Dice;
use AdventurersGuild\Quest;

class QuestFactory
{
    public function createQuest()
    {
        list($dc, $reward, $difficulty) = $this->generateQuestStats();
        $questType = $this->generateQuestType();
        $quest = new Quest;
        $quest->setDc($dc)->setReward($reward)->setType($questType)->setDifficulty($difficulty);
        return $quest;
    }

    public function misunderstandQuest(Quest $quest)
    {
        $questType = $quest->getType();
        if (!$questType) {
            throw new \InvalidArgumentException;
        }

        // make sure it's not the same as the original type
        $newType = $this->generateQuestType();
        while ($newType == $questType) {
            $newType = $this->generateQuestType();
        }

        $misunderstoodQuest = clone $quest;
        $misunderstoodQuest->setType($newType);

        return $misunderstoodQuest;
    }

    public function generateQuestType()
    {
        return Config::QUEST_TYPES[Dice::roll(1,6) - 1];
    }

    protected function generateQuestStats() {
        // if ($dcRoll) { // @todo test
        //     $dc = dcRoll();
        // } else {
            $dc = Dice::roll(2,10,5); // 2d10 + 5
        // }

        $difficulty = '';
        if ($dc <= Config::MAX_DC_EASY) {
            $difficulty = Quest::DIFFICULTY_EASY;
        } elseif ($dc <= Config::MAX_DC_MEDIUM) {
            $difficulty = Quest::DIFFICULTY_MEDIUM;
        } elseif ($dc <= Config::MAX_DC_HARD) {
            $difficulty = Quest::DIFFICULTY_HARD;
        } else {
            $difficulty = Quest::DIFFICULTY_VERY_HARD;
        }

        $cash = 0;
        $loReward = 0;
        $hiReward = 0;
        if ($difficulty == Quest::DIFFICULTY_EASY) {
            $lo = Config::DC_EASY_CASH[0];
            $hi = Config::DC_EASY_CASH[1];
        } elseif ($difficulty == Quest::DIFFICULTY_MEDIUM) {
            $lo = Config::DC_MEDIUM_CASH[0];
            $hi = Config::DC_MEDIUM_CASH[1];
        } elseif ($difficulty == Quest::DIFFICULTY_HARD) {
            $lo = Config::DC_HARD_CASH[0];
            $hi = Config::DC_HARD_CASH[1];
        } else {
            $lo = Config::DC_VERY_HARD_CASH[0];
            $hi = Config::DC_VERY_HARD_CASH[1];
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

        $cash = round($cash);
        return [$dc, $cash, $difficulty];
    }
}
