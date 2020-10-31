<?php

namespace AdventurersGuild;

use Config\Config;
use AdventurersGuild\Dice;
use AdventurersGuild\Quest;
use AdventurersGuild\Adventurer;

class AdventurerFactory
{
    // judgement: excellent, good, adequate, poor
    public function createQuestAdventurer(Quest $quest, $judgement)
    {
        $questType = $quest->getType();
        if (!$questType) {
            throw new \InvalidArgumentException;
        }

        $adventurerClassesForQuest = Config::QUEST_ADVENTURERS[$questType];

        $chosenClass;
        // make sure there are 4 adventurer classes in the class array
        for ($i = 0; $i < 4; $i++) {
            // if there already is a value set, continue
            if (array_key_exists($i, $adventurerClassesForQuest) && $adventurerClassesForQuest[$i]) {
                continue;
            }

            foreach (Config::CLASSES as $class) {
                if (in_array($class, $adventurerClassesForQuest)) {
                    continue;
                }

                $adventurerClassesForQuest[$i] = $class;
            }
        }

        switch ($judgement) {
            case 'excellent':
                $chosenClass = $adventurerClassesForQuest[0];
                break;

            case 'good':
                $chosenClass = $adventurerClassesForQuest[1];
                break;

            case 'adequate':
                $chosenClass = $adventurerClassesForQuest[2];
                break;

            case 'poor':
                $chosenClass = $adventurerClassesForQuest[3];
                break;
        }

        return $this->createAdventurer($chosenClass);
    }

    public function createRandomAdventurer() {
        $index = rand(0,count(Config::CLASSES) - 1);
        $className = Config::CLASSES[$index];
        return $this->createAdventurer($className);
    }

    public function createAdventurer($className)
    {
        $classAttributes = Config::CLASS_ATTRIBUTES[$className];

        $statCount = 6;
        $stats = [];

        for ($i = 0; $i < $statCount; $i++) {
            $rolls = [];
            for ($j = 0; $j < 4; $j++) {
                array_push($rolls, Dice::roll(1, 6));
            }

            $min = min($rolls);

            foreach ($rolls as $j => $roll) {
                if (count($rolls) < 4) {
                    continue;
                }

                if ($roll == $min) {
                    unset($rolls[$j]);
                }
            }

            $rolls = array_values($rolls);
            $stat = array_sum($rolls);

            array_push($stats, $stat);
        }

        rsort($stats, SORT_NUMERIC);

        $adventurer = new Adventurer;
        $adventurer->setClass($className);


        foreach ($classAttributes as $index => $attribute) {
            $matches = [];
            if (preg_match('/([a-zA-z]+)(?:\/)([a-zA-z]+)/', $attribute, $matches)) {
                $attribute = $matches[1]; // temporary
            }

            $adventurer->{'set' . ucFirst($attribute)}($stats[$index]);
            unset($stats[$index]);
            $stats = array_values($stats);
        }

       foreach (Config::STAT_TYPES as $i => $statType) {
            shuffle($stats);
            if ($adventurer->{'get' . ucFirst($statType)}()) {
                continue;
            }

            $adventurer->{'set' . ucFirst($statType)}($stats[0]);
            unset($stats[0]);
            $stats = array_values($stats);
        }

        return $adventurer;
    }
}
