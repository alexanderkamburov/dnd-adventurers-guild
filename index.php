<?php

use Config\Config;
use AdventurersGuild\Dice;
use AdventurersGuild\Adventurer;
use AdventurersGuild\QuestFactory;
use AdventurersGuild\AdventurerFactory;
require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . '/src/roll.php';

// var_dump(Dice::roll(1,6));

// per stat: roll 4d6, drop lowest, sum; repeat for each stat; match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die
// ([a-zA-z]+)(?:\/)([a-zA-z]+)

// $adventurerFactory = new AdventurerFactory;
// $adventurer = $adventurerFactory->createAdventurer();
// var_dump($adventurer);

// $questFactory = new QuestFactory();
// $stats = $questFactory->generateQuestStats();
// var_dump($stats);

