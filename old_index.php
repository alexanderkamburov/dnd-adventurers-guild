<?php

use Config\Config;
use AdventurersGuild\Dice;
use AdventurersGuild\Adventurer;
use AdventurersGuild\QuestFactory;
use AdventurersGuild\AdventurerFactory;
use AdventurersGuild\AdventureSimulator;
require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . '/src/roll.php';

// var_dump(Dice::roll(1,6));

// per stat: roll 4d6, drop lowest, sum; repeat for each stat; match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die
// ([a-zA-z]+)(?:\/)([a-zA-z]+)

$adventurerFactory = new AdventurerFactory;
// $adventurer = $adventurerFactory->createRandomAdventurer();
// var_dump($adventurer);


$questFactory = new QuestFactory();
// manager stuff
// generate quest
$quest = $questFactory->createQuest();
$perceivedQuest = $quest;

$understandQuest = Dice::roll(1, 100);
if ($understandQuest <= 15) {
    // misunderstand quest
    $perceivedQuest = $questFactory->misunderstandQuest($quest);
}

$adventurerJudgementRoll = Dice::roll(1, 100);
switch ($adventurerJudgementRoll) {
    case $adventurerJudgementRoll <= 40:
        $adventurerJudgement = 'excellent';
        break;

    case $adventurerJudgementRoll <= 65:
        $adventurerJudgement = 'good';
        break;

    case $adventurerJudgementRoll <= 90:
        $adventurerJudgement = 'adequate';
        break;

    default:
        $adventurerJudgement = 'poor';
        break;
}
var_dump($adventurerJudgement);

$adventurer = $adventurerFactory->createQuestAdventurer($perceivedQuest, $adventurerJudgement);

var_dump($quest, $adventurer);

$adventureSimulator = new AdventureSimulator($questFactory);
$adventureSimulator->simulateQuest($quest, $adventurer);


