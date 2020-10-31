<?php

namespace AdventurersGuild;

use Config\Config;
use AdventurersGuild\Quest;
use AdventurersGuild\Adventurer;

/**
 * @todo  for different dcs, use more than adventurer
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

    public function simulateQuest(Quest $quest, Adventurer $adventurer, GuildManagerReport $report)
    {
        $report->setQuest($quest);

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
            $report->setComplication(true);
            $complicationType = $this->questFactory->generateQuestType();
            $report->setComplicationType($complicationType);
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
        // if ($complication) {
        //     $reward *= 2;
        // }

        // todo think about extra loot + terms

        switch ($tally) {
            case $tally == 3:
                $report->markCompleteSuccess()->setReward($reward);
                $hasInjuryRoll = Dice::roll(1,100);
                if ($hasInjuryRoll == 1) {
                    $injuryTypeRoll = Dice::roll(1,100);
                    if ($injuryTypeRoll <= 50) {
                        $report->setAdventurerStatusMinorInjury();
                    } else {
                        $report->setAdventurerStatusLightInjury();
                    }
                }
                // very small chance, max light injury 1/100
                break;

            case $tally == 2:
                $reward = $reward / 2;
                $report->markCloseSuccess()->setReward($reward);
                // 10/100, max light
                break;

            case $tally == 1:
                $report->markCloseFailure();
                // 20/100, max moderate
                break;

            case $tally == 0:
                $report->markCompleteFailure();
                // 75/100, no holds barred
                break;
        }

        if ($report->isCompleteFailure()) {
            // do injury stuff
        }

        return $report;
    }
}
