<?php

use AdventurersGuild\GuildManager;
use AdventurersGuild\QuestFactory;
use AdventurersGuild\AdventurerFactory;

require __DIR__ . '/vendor/autoload.php';

$manager = new GuildManager(new AdventurerFactory, new QuestFactory);

$repetitions = 10000;

$p = new \stdClass;
$p->revenue = 0;
$p->adventurerShare = 0;
$p->guildShare = 0;
$p->totalFailedQuests = 0;
$p->totalSuccededQuests = 0;
$p->easyQuests = ['succeeded' => 0, 'failed' => 0];
$p->mediumQuests = ['succeeded' => 0, 'failed' => 0];
$p->hardQuests = ['succeeded' => 0, 'failed' => 0];
$p->veryHardQuests = ['succeeded' => 0, 'failed' => 0];


for ($i=0; $i < $repetitions; $i++) {
    $mr = $manager->manageGuild();
    $difficulty = $mr->getQuest()->getDifficulty();
    if (!$mr->isQuestFailed()) {
        $p->revenue += $mr->getReward();
        $p->adventurerShare += $mr->getAdventurerShare();
        $p->guildShare += $mr->getGuildShare();
        $p->totalSuccededQuests += 1;

        $p->adventurerShare += $mr->getAdventurerShare();
    } else {
        $p->totalFailedQuests += 1;
    }

    switch ($difficulty) {
        case 'easy':
            if ($mr->isQuestFailed()) {
                $p->easyQuests['failed'] += 1;
            } else {
                $p->easyQuests['succeeded'] += 1;
            }
            break;

        case 'medium':
            if ($mr->isQuestFailed()) {
                $p->mediumQuests['failed'] += 1;
            } else {
                $p->mediumQuests['succeeded'] += 1;
            }
            break;

        case 'hard':
            if ($mr->isQuestFailed()) {
                $p->hardQuests['failed'] += 1;
            } else {
                $p->hardQuests['succeeded'] += 1;
            }
            break;

        case 'very hard':
            if ($mr->isQuestFailed()) {
                $p->veryHardQuests['failed'] += 1;
            } else {
                $p->veryHardQuests['succeeded'] += 1;
            }
            break;
    }
}
var_dump($p);





// var_dump($report);
