<?php

namespace AdventurersGuild;

use Config\Config;
use AdventurersGuild\Quest;
use AdventurersGuild\Adventurer;

/**
 * @todo  add injuries
 * @todo  add death
 */
class AdventureSimulator
{
    protected $questFactory;

    public function __construct(QuestFactory $questFactory)
    {
        $this->questFactory = $questFactory;
    }

    public function simulateQuest(Quest $quest, Adventurer $adventurer, GuildManagerReport $outcome)
    {
        $outcome->setQuest($quest);

        $questDc = $quest->getDc();
        $questType = $quest->getType();
        $skillsToCheck = Config::QUEST_SKILLS[$questType];

        $complicationRoll = Dice::roll(1, 20);
        $complication = false;
        if ($quest->isEasy() && $complicationRoll == 1) {
            $complication = true;
        } elseif ($quest->isMedium() && $complicationRoll <= 2) {
            $complication = true;
        } elseif ($quest->isHard() && $complicationRoll <= 4) {
            $complication = true;
        } elseif ($quest->isHard() && $complicationRoll <= 5) {
            $complication = true;
        }

        if ($complication) {
            $outcome->setComplication(true);
            $complicationType = $this->questFactory->generateQuestType();
            $outcome->setComplicationType($complicationType);
            $skillsToCheck = array_merge($skillsToCheck, Config::QUEST_SKILLS[$complicationType]);
        }

        $tally = 0;
        foreach ($skillsToCheck as $skillToCheck) {
            $attribute = Config::SKILL_CHECKS[$skillToCheck];
            $modifier = Adventurer::calculateAttributeModifier($adventurer->{'get' . ucFirst($attribute)}());
            $roll = Dice::roll(1,20,$modifier);

            if ($roll <= $questDc) {
                $tally+= 0;
            } else {
                $tally+= 1;
            }
        }

        if ($complication && $tally > 0) {
            $tally = round($tally / 2, 0, PHP_ROUND_HALF_DOWN);
        }

        $reward = $quest->getReward();
        if ($complication) {
            $reward *= 2;
        }

        switch ($tally) {
            case $tally == 3:
                $outcome->markCompleteSuccess()->setReward($reward);
                break;

            case $tally == 2:
                $reward = $reward / 2;
                $outcome->markCloseSuccess()->setReward($reward);
                break;

            case $tally == 1:
                $outcome->markCloseFailure();
                break;

            case $tally == 0:
                $outcome->markCompleteFailure();
                break;
        }

        if ($outcome->isCompleteFailure()) {
            // do injury stuff
        }

        return $outcome;
    }
}
