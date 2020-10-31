<?php

namespace AdventurersGuild;

use Config\Config;
use AdventurersGuild\Dice;
use AdventurersGuild\Adventurer;

class AdventurerFactory
{
    public function createAdventurer() {
        $index = rand(0,count(Config::CLASSES) - 1);
        $className = array_keys(Config::CLASSES)[$index];
        $class = array_values(Config::CLASSES)[$index];

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


        foreach ($class as $index => $attribute) {
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
